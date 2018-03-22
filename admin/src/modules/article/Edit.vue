<template>
    <div class="layout-article-edit">
        <el-form :model="editForm" :rules="rules" ref="editForm" label-width="100px" class="demo-editForm">
            <el-form-item label="文章标题" prop="title">
                <el-input v-model="editForm.title"></el-input>
            </el-form-item>
            <el-form-item label="作者" prop="author">
                <el-input v-model="editForm.author"></el-input>
            </el-form-item>
            <el-form-item label="文章分类" prop="category_id">
                <el-select v-model="editForm.category_id" placeholder="请选择文章分类">
                    <el-option :label="item.name" :key="item.id" :value="item.id" v-for="item in categoryOptions"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="文章简介" prop="intro">
                <el-input type="textarea" v-model="editForm.intro"></el-input>
            </el-form-item>
            <el-form-item prop="detail">
                <mavon-editor ref="me" v-model="editForm.detail" @imgAdd="imgAdd" @imgDel="imgDel"></mavon-editor>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="submitForm('editForm')">添加</el-button>
                <el-button @click="resetForm('editForm')">重置</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>
<script>
    import Vue from 'vue';
    import {Form, FormItem, Input, Button, Select, Option} from 'element-ui'
    import axios from 'axios';
    const mavonEditor = require('mavon-editor');
    const qiniu = require('qiniu-js');
    const cryptoJS = require('crypto-js');
    import 'mavon-editor/dist/css/index.css'
    Vue.use(Form)
    Vue.use(FormItem)
    Vue.use(Input)
    Vue.use(Button)
    Vue.use(Select)
    Vue.use(Option)
    export default {
        components:{
            'mavon-editor': mavonEditor['mavon-editor'].mavonEditor
        },
        data() {
            return {
                editForm: {
                    title: '',
                    author:'',
                    category_id: '',
                    intro: '',
                    detail:''
                },
                token:'',
                categoryOptions:[],
                rules: {
                    title: [
                        { required: true, message: '请输入文章标题', trigger: 'blur' },
                    ],
                    category_id: [
                        { required: true, message: '请选择文章分类', trigger: 'change' }
                    ]
                }
            };
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        axios.post('http://homestead.test/article/add',this.editForm).then((response)=>{
                            console.log(response);
                        }).catch((response)=>{
                            console.log(response)
                        })
                    } else {
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },
            imgAdd(pos, file){
                const keyArr = file.name.split('.');
                const key = this.s4()+Date.now()+this.s4()+'.'+keyArr[1];
                const putExtra = {
                    mimeType: null
                };
                const config = {
                };
                const observable = qiniu.upload(file.miniurl, file.name, this.token, putExtra, config);
                const _this = this;
                observable.subscribe({
                    next(res){
                        // ...
                    },
                    error(err){
                        // ...
                    },
                    complete(res){
                        _this.getUrl(pos,res.key);
                    }
                })
            },
            imgDel(){

            },
            getCategory(){
                axios.get('http://homestead.test/article_category/all').then((response)=>{
                    this.categoryOptions = response.data;
                }).catch((response)=>{
                    console.log(response)
                })
            },
            getUrl(pos, key){
                axios.get('http://homestead.test/qiniu/url',{params: {key}}).then(({data})=>{
                    this.$refs.me.$img2Url(pos, data.url);
                }).catch((response)=>{
                    console.log(response)
                })
            },
            getToken(){
                axios.get('http://homestead.test/qiniu/token').then(({data})=>{
                    this.token = data;
                }).catch((response)=>{
                    console.log(response)
                })
            },
            s4(){
                return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
            }

        },
        mounted(){
            this.getCategory();
            this.getToken();
        }
    }
</script>
<style>

</style>