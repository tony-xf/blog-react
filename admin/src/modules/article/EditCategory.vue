<template>
    <div class="layout-article-category-edit">
        <el-tree
            :data="categoryOptions"
            show-checkbox
            node-key="id"
            default-expand-all
            :expand-on-click-node="false">
             <div class="custom-tree-node" slot-scope="{ node, data }">
                 <div class="edit-form" v-if="data.isEdit">
                     <span class="label">
                         <input v-model="editForm.name" placeholder="请输入分类名称"/>
                     </span>
                     <span class="operation" v-if="data.isAdd">
                         <el-button
                                 type="text"
                                 size="mini"
                                 @click="() => saveAddNode(node, data)">
                             保存
                         </el-button>
                         <el-button
                                 type="text"
                                 size="mini"
                                 @click="() => removeNode(node, data)">
                             取消
                         </el-button>
                     </span>
                     <span class="operation" v-else>
                         <el-button
                                 type="text"
                                 size="mini"
                                 @click="() => saveEditNode(node, data)">
                             修改
                         </el-button>
                         <el-button
                                 type="text"
                                 size="mini"
                                 @click="() => cancelEdit(node, data)">
                             取消
                         </el-button>
                     </span>
                 </div>

                 <div class="tree-node" v-else>
                     <span class="label">{{ node.label }}</span>
                     <div class="operation">
                         <el-button
                                 type="text"
                                 size="mini"
                                 @click="() => addChildren(data)">
                             添加子分类
                         </el-button>
                         <el-button
                                 type="text"
                                 size="mini"
                                 @click="() => showEditForm(data)">
                             编辑
                         </el-button>
                         <el-button
                                 type="text"
                                 size="mini"
                                 @click="() => removeNode(node, data)">
                             删除
                         </el-button>
                     </div>
                 </div>
              </div>
        </el-tree>
    </div>
</template>
<script>
    import Vue from 'vue';
    import {Form, FormItem, Input, Button, Select, Option, Tree, Dialog} from 'element-ui'
    import { generateTree, findChild} from '../../util/tools'
    import axios from 'axios';
    Vue.use(Form)
    Vue.use(FormItem)
    Vue.use(Input)
    Vue.use(Button)
    Vue.use(Select)
    Vue.use(Option)
    Vue.use(Tree)
    Vue.use(Dialog)
    export default {
        data() {
            return {
                dialogTableVisible:false,
                key: 1,
                editForm: {
                    name: '',
                    category_id: '',
                },
                categoryOptions:[],
                rules: {
                    name: [
                        { required: true, message: '请输入文章标题', trigger: 'blur' },
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
            addChildren(data){
                this.key++;
                const newChild = { id: this.key, label: '', children: [], isEdit: true, isAdd: true, loading: false };
                if (!data.children) {
                    this.$set(data, 'children', []);
                }
                data.children.push(newChild);
            },
            showEditForm(data){ 
                data.isEdit = true;
                data.isAdd = false;
                this.editForm.name = data.name;
            },
            saveEditNode(node, data){
                const params = {
                    p_id: node.parent.data.id,
                    name: this.editForm.name
                }
                axios.put('http://homestead.test/article_category/edit/'+data.id,params).then((res)=>{
                    data.isEdit = false;
                    data.label = this.editForm.name;
                    this.editForm.name = '';
                }).catch(()=>{

                });
            },
            saveAddNode(node, data){
                const params = {
                    p_id: node.parent.data.id,
                    name: this.editForm.name
                }
                axios.post('http://homestead.test/article_category/add', params).then((res)=>{
                    data.isEdit = false;
                    data.label = this.editForm.name;
                    this.editForm.name='';
                }).catch(()=>{

                });
            },
            cancelEdit(node, data){
                data.isEdit = false;
                this.editForm.name='';
            },
            removeNode(node, data){
                const parent = node.parent;
                const children = parent.data.children || parent.data;
                const index = children.findIndex(d => d.id === data.id);
                if(data.isAdd){
                    children.splice(index, 1);
                }else{
                    axios.delete('http://homestead.test/article_category/del/'+data.id).then((res)=>{
                        children.splice(index, 1);
                    }).catch(()=>{

                    });
                }
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            },
            getCategory(){
                axios.get('http://homestead.test/article_category/all').then((response)=>{
                    response.data.map((item)=>{
                        item['label'] = item.name;
                        item['isEdit'] = false;
                        item['isAdd'] = false;
                        item['loading'] = false;
                        return item;
                    })
                    const arr = generateTree(response.data);
                    this.categoryOptions = arr;
                }).catch((response)=>{
                })
            }
        },
        mounted(){
            this.getCategory();
        }
    }
</script>
<style lang="scss">
    .layout-article-category-edit{
        .custom-tree-node{
            width: 100%;
        }
        .tree-node{
            display: flex;
            width: 100%;
            .operation{
                flex: 0 0 120px;
            }
            .label{
                display: flex;
                flex-grow: 1;
                align-items: center;
            }
        }

        input{
            border: 1px solid #e6e6e6;
            height: 24px;
            line-height: 22px;
            padding: 0 5px;
            border-radius: 3px;
        }
    }
</style>