import React from 'react';
import { Link } from 'react-router-dom';
import '../static/style/page/blog.scss';

class Home extends React.Component{
    constructor(props){
        super(props);
    }
    componentDidMount(){
        console.log(this.props);
    }
    render(){
        const match = this.props.match;
        return(
            <div className="blog-page">
                <ul className="category main-header">
                    <li className="active"><Link to={`${match.url}/components`}>全部</Link></li>
                    <li><Link to={`${match.url}/components`}>JS</Link></li>
                    <li><Link to={`${match.url}/components`}>JQUERY</Link></li>
                    <li><Link to={`${match.url}/components`}>REACT</Link></li>
                    <li><Link to={`${match.url}/components`}>VUE</Link></li>
                    <li><Link to={`${match.url}/components`}>PHP</Link></li>
                </ul>
                <div className="container main-content">
                    <div className="cont-header cont-item">
                        <span className="item-left">文章标题</span>
                        <span className="item-right">发表时间</span>
                    </div>
                    <ul className="cont-list">
                        <li className="cont-item">
                            <span className="item-left"><a>响应式布局方案</a></span>
                            <span className="item-right">2017-12-19 23:05</span>
                        </li>
                        <li className="cont-item">
                            <span className="item-left"><a>响应式布局方案</a></span>
                            <span className="item-right">2017-12-19 23:05</span>
                        </li>
                        <li className="cont-item">
                            <span className="item-left"><a>响应式布局方案</a></span>
                            <span className="item-right">2017-12-19 23:05</span>
                        </li>
                    </ul>
                    <div className="cont-footer">
                        <div className="search">
                            <input type="text" placeholder="按文章标题搜索..."/>
                            <i className="icon icon-enter"></i>
                        </div>
                        <div className="paging">
                            <span>共2条</span>
                            <a className="prev"><i className="icon icon-radius-arrow-left"></i></a>
                            <span>1</span> / <span>1</span>
                            <a className="next"><i className="icon icon-radius-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
export default Home;