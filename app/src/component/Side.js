import React from 'react';
import { Link} from 'react-router-dom';
class Side extends React.Component{
    constructor(props){
        super(props);
    }
    render(){
        return (
            <div className="side">
                <div className="avatar">
                    <img src="https://avatars1.githubusercontent.com/u/14285531?v=4" alt="头像"/>
                    <h4 className="name">一介布衣</h4>
                </div>
                <div className="icon-bar">
                    <a href="https://github.com/tony-xf" target="_blank"><i className="icon icon-github"></i></a>
                    <i className="icon icon-wechat"></i>
                    <i className="icon icon-qq"></i>
                </div>
                <ul className="nav">
                    <li className="active"><Link to="/">个人博客</Link></li>
                    <li><Link to="/">关于我</Link></li>
                </ul>
                <div className="copy">

                </div>
            </div>
        )
    }
}
export default Side;