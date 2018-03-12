import React from 'react';
import axios from 'axios';
import marked from 'marked';
import '../../static/style/page/detail.scss';
class Detail extends React.Component{
    constructor(props){
        super(props)
        this.state={
            title: '',
            author: '',
            time: '',
            detail:'',
            clicks: ''
        }
    }
    componentDidMount(){
        const id = this.props.match.params.articleId;
        if(id){
            this.getArticle(id);
        }
    }
    getArticle = (id) => {
        axios.get('http://homestead.test/article/detail/'+id).then(({data})=>{
            this.setState({title: data.title, author: data.author, time: data.time, detail: data.detail, clicks: data.clicks});
        }).catch(()=>{

        });
    }
    render(){
        const html = marked(this.state.detail, {sanitize: true})
        return(<div className="article-page">
            <div className="main-header">{this.state.title}</div>
            <div className="main-content">
                <div className="info">
                    <span>作者：{this.state.author || 'admin'}</span>
                    <span>点击量：{this.state.clicks}</span>
                    <span>更新时间：{this.state.time}</span>
                </div>
                <div className="detail" dangerouslySetInnerHTML={{__html:html}}>
                </div>
            </div>
        </div>)
    }
}
export default Detail