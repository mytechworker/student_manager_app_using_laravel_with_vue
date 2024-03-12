<template>
    <div class="row">
        <div class="col-12">
            <ul>
                <li v-for="item in error" :key="item">
                    {{item}} not valid
                </li>
            </ul>
            <div class="card">
                <div class="card-header">
                    <h4>Add Student</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create" ref="add" class="col-md-6">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" v-model="student.username" class="form-control" id="username">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" v-model="student.email" class="form-control" id="email">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mr-10">Add Student</button>
                        <button type="reset" class="btn btn-secondary" v-on:click="reset()">Reset</button>
                        <router-link to="/" class="btn btn-primary">Back</router-link>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"AddStudent",
    data(){
        return {
            student:{
                username:"",
                email:""
            },
            error:[]
        }
    },
    methods:{
        async create(){
            this.error=[];
            for(const item in this.student)
			{
                console.log('this.student ===== ',this.student);
				if(this.student[item]=="" || this.student[item].length==0)
				{
					this.error.push(item)
				}
			}
            if(this.error.length==0)
            {
                var data ={
                    'username' : this.$refs.add.username.value,
                    'email' : this.$refs.add.email.value,
                }
                var config = {
                method: "post",
                url: "/api/students",
                data: data
                };
                axios(config).then(function (response) {
                    if(response.data.status=='success')
                    {
                        window.location.href='/'
                    }
                    
                }).catch(error=>{
                    window.location.href='/add'
                });
            }
                
        },
        reset()
        {
            this.student.username='',
            this.student.email=''
        }
    }
}
</script>