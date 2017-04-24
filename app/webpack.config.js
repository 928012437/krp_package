var path = require('path'); //node 路径对象
var glob = require('glob');
var webpack = require('webpack');

//插件
var ExtractTextPlugin = require('extract-text-webpack-plugin');
var HtmlWebpackPlugin = require('html-webpack-plugin');
var CommonsChunkPlugin = webpack.optimize.CommonsChunkPlugin;
var UglifyJsPlugin = webpack.optimize.UglifyJsPlugin;
var OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');

//js入口文件
var entries = getEntry('src/js/**/*.js','src/js/');
var chunks = Object.keys(entries);

if(process.env.NODE_ENV=='development'){
}

var p = process.env.NODE_ENV == 'development' ? '/dist/' : '../';
console.log('-----------------------------'+p+'-----------------')


//配置
var config ={
	entry:entries,
	output:{
		path:path.resolve(__dirname,'./dist'),
		publicPath:p,
		filename:'js/[name].js',
		chunkFilename: 'js/[id].chunk.js?[chunkhash]'
	},
	module:{
		loaders:[
			{
		        test: /\.css$/,
		        use: ExtractTextPlugin.extract({
		          fallback: "style-loader",
		          use: "css-loader"
	       		})
      		},{
      			test: /\.less$/,
		        use: ExtractTextPlugin.extract({
		          fallback: "style-loader",
		          use: "css-loader!less-loader"
	       		})

      		},{
				test: /\.html$/,
				loader: "html-loader?-minimize"	//避免压缩html,https://github.com/webpack/html-loader/issues/50
			}, {
				test: /\.(woff|woff2|ttf|eot|svg)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
				loader: 'file-loader?name=fonts/[name].[ext]'
			}, {
				test: /\.(png|jpe?g|gif)$/,
				loader: 'url-loader?limit=8192&name=imgs/[name]-[hash].[ext]'
			}, {
              test: /\.js$/,
              loader: 'babel-loader',
              exclude: /node_modules/
           	}
		]
	},
	plugins:[
		new webpack.ProvidePlugin({
			$:'n-zepto',
			Zepto:'n-zepto'
		}),
		new CommonsChunkPlugin({
			name:'vendors',
			chunks:chunks,
			minChunks:chunks.length
		}),
		new ExtractTextPlugin('style/[name].css'),
		new OptimizeCssAssetsPlugin({
	        assetNameRegExp: /\.css$/g,
	        cssProcessor: require('cssnano'),
	        cssProcessorOptions: { discardComments: {removeAll: true } },
	        canPrint: true
        }),
		new webpack.HotModuleReplacementPlugin() //热加载

	],
}


// html文件
var pages = Object.keys(getEntry('src/view/**/*.html', 'src/view/'));
pages.forEach(function(pathname) {
    var conf = {
        filename: 'view/' + pathname + '.html', //生成的html存放路径，相对于path
        template: 'src/view/' + pathname + '.html', //html模板路径
        inject: false, //js插入的位置，true/'head'/'body'/false
    }
    if (pathname in config.entry) {
        conf.inject = 'body';
        conf.chunks = ['vendors', pathname];
        conf.hash = true;
    }
    config.plugins.push(new HtmlWebpackPlugin(conf));
})

//获取文件的方法函数 获取的一个文件对象{文件名 ：文件路径}
function getEntry(globPath, pathDir){
    var files = glob.sync(globPath);
    var entries = {},
  entry, dirname, basename, pathname, extname;
    for (var i = 0; i < files.length; i++) {
        entry = files[i];
        dirname = path.dirname(entry);//目录路径
        extname = path.extname(entry);//扩展名.js/.html
        basename = path.basename(entry, extname);//文件名
        pathname = path.normalize(path.join(dirname,  basename));
        pathDir = path.normalize(pathDir);
        if(pathname.startsWith(pathDir)){
            pathname = pathname.substring(pathDir.length)
        }
        entries[pathname] = ['./' + entry];
    }
    return entries;
}




module.exports = config;