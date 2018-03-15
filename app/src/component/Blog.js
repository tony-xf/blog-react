import React from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';
import '../static/style/page/blog.scss';

class Home extends React.Component{
    constructor(props){
        super(props);
        this.state={
            page: 1,
            pageSize: 1,
            total: 0 ,
            list: [],
            size: 0,
            loading: false,
            categoryList: [],
            selected: '32AB068B-DF66-3D59-47BC-10C5F0132D52',
            keywords:'',
        }
    }
    componentDidMount(){
        this.getArticleList();
        this.getAllArticleCategory();
    }
    getArticleList = () =>{
        this.setState({loading: true});
        console.log(this.state);
        axios.get('http://homestead.test/article/all',{
            params:{
                page: this.state.page,
                pageSize: this.state.pageSize,
                keywords: this.state.keywords
            }
        }).then(({data})=>{
            const num = Math.ceil(data.total/this.state.pageSize);
            this.setState({list:data.data, total: data.total, size: num, loading: false});
        }).catch(()=>{
            this.setState({loading: false});
        });
    }
    getAllArticleCategory = ()=>{
        axios.get('http://homestead.test/article_category/all').then(({data})=>{
            this.setState({categoryList: data});
        }).catch(()=>{

        })
    }
    handlePrev = () =>{
        if(this.state.loading){
            return;
        }
        if(this.state.page > 1){
            this.setState({page: this.state.page-1},()=>{
                this.getArticleList();
            });
        }
    }
    handleNext = () =>{
        if(this.state.loading){
            return;
        }
        if(this.state.page < this.state.size){
            this.setState({page: this.state.page+1},()=>{
                this.getArticleList();
            });
        }
    }
    handleSearch=()=>{
        this.setState({page: 1, pageSize: 15});
        this.getArticleList();
    }
    handleChange=(e)=>{
        this.setState({keywords: e.target.value});
    }
    render(){
        const match = this.props.match;
        return(
            <div className="blog-page">
                <ul className="category main-header">
                    {this.state.categoryList.map((item)=>{
                        return <li key={item.id} className={item.id == this.state.selected ? 'active': ''}>{item.name}</li>
                    })}
                    {/*<li className="active"><Link to={`${match.url}/components`}>全部</Link></li>*/}
                    {/*<li><Link to={`${match.url}/components`}>JS</Link></li>*/}
                    {/*<li><Link to={`${match.url}/components`}>JQUERY</Link></li>*/}
                    {/*<li><Link to={`${match.url}/components`}>REACT</Link></li>*/}
                    {/*<li><Link to={`${match.url}/components`}>VUE</Link></li>*/}
                    {/*<li><Link to={`${match.url}/components`}>PHP</Link></li>*/}
                </ul>
                <div className="container main-content">
                    <div className="cont-header cont-item">
                        <span className="item-left">文章标题</span>
                        <span className="item-right">发表时间</span>
                    </div>
                    <ul className="cont-list">
                        {this.state.list.map((item)=>{
                            return <li className="cont-item" key={item.id}>
                                <span className="item-left"><Link to={`${match.url}article/${item.id}`}>{item.title}</Link></span>
                                <span className="item-right">{item.date}</span>
                            </li>
                        })}
                    </ul>
                    <div className="cont-footer">
                        <div className="search">
                            <input type="text" placeholder="按文章标题搜索..." value={this.state.keywords} onChange={this.handleChange}/>
                            <i className="icon icon-enter" onClick={this.handleSearch}></i>
                        </div>
                        <div className="paging">
                            <span>共{this.state.total}条</span>
                            <a className="prev" onClick={this.handlePrev}><i className="icon icon-radius-arrow-left"></i></a>
                            <span>{this.state.page}</span> / <span>{this.state.size}</span>
                            <a className="next" onClick={this.handleNext}><i className="icon icon-radius-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
export default Home;