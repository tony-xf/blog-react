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
                    <el-option label="区域一" value="shanghai"></el-option>
                    <el-option label="区域二" value="beijing"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="活动形式" prop="intro">
                <el-input type="textarea" v-model="editForm.intro"></el-input>
            </el-form-item>
            <el-form-item prop="detail">
                <mavon-editor v-model="editForm.detail"></mavon-editor>
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
    var mavonEditor = require('mavon-editor');
    import 'mavon-editor/dist/css/index.css'
    Vue.use(Form)
    Vue.use(FormItem)
    Vue.use(Input)
    Vue.use(Button)
    Vue.use(Select)
    Vue.use(Option)
    export default {
        components: {
            'mavon-editor': mavonEditor.mavonEditor
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
                        alert('submit!');
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            }
        }
    }
</script>
<style>

</style>