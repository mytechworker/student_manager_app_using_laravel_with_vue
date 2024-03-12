<template>
    <div class="row">
        <div class="text-center">
            <h1>Student List</h1>
        </div>
        <div class="col-8 mb-2 text-start">
            <router-link to="/add" class="btn btn-primary">Create Student</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="margin: 0 auto; width: 70%;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(student,key) in students.data" :key="key">
                                    <td>{{ student.id }}</td>
                                    <td>{{ student.username }}</td>
                                    <td>{{ student.email }}</td>
                                    <td>
                                        <b-button type="button" @click="deleteStudent(student.id)" class="btn btn-danger">Delete</b-button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="paginate">
                <ul>
                    <li v-for="item in students.last_page" :key="item" @click="pagination(item)">{{ item }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name:"categories",
    data(){
        return {
            students:[],
            item:1,
        }
    },
    mounted(){
        this.getStudents()
    },
    methods:{
        async getStudents(item){
            await axios.get(`/api/students?page=${item}`,{
            }).then(response=>{
                this.students = response.data
                if(item!=1)
                {
                     this.$router.push({path:'/',query:{page:item}});
                }
                else
                {
                    this.$router.push({path:'/'});
                }
               
            }).catch(error=>{
                this.students = []
            })
        },
        deleteStudent(id){
            if(confirm("Are you sure to delete this student ?")){
                axios.delete(`/api/students/${id}`,{
            }).then(response=>{
                    this.getStudents()
                }).catch(error=>{
                })
            }
        },
        pagination(item)
        {
            this.getStudents(item)
        },
    }
}
</script>
<style>
.paginate {
    margin-top: 20px;
}
.paginate ul {
    display: flex;
    justify-content: center;
    align-items: center;
}
.paginate ul li {
    list-style: none;
    width: 30px;
    height: 30px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid;
    cursor: pointer;
}
</style>