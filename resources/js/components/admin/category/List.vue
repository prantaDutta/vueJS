<template>
    <div>
        <!-- Main content -->
        <section class="content">
            <div class="row justify-content-around">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Category List</h3>
                            <div class="card-tools">
                                <router-link to="/add-category" class="btn btn-success">Add Category</router-link>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>
                                        <select name="" id=""  @change="deleteSelected" v-model="select">
                                            <option value="">Select</option>
                                            <option value="">Delete All</option>
                                        </select><br>
                                        <input type="checkbox" @click="selectAll" v-model="allSelect">
                                        <span v-if="allSelect == false">Check All</span>
                                        <span v-if="allSelect == true">Uncheck All</span>
                                    </th>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(category,index) in getAllCategory" :key="category.id">
                                    <td><input type="checkbox" v-model="categoryItem" :value="category.id"></td>
                                    <td>{{ index+1 }}</td>
                                    <td>{{ category.cat_name }}</td>
                                    <td>{{ category.created_at | timeformat }}</td>
                                    <td><router-link :to="`/edit-category/${category.id}`" class="btn btn-primary" href="">Edit</router-link>
                                        <a class="btn btn-danger" href="" @click.prevent = "deleteCategory(category.id)">Delete</a>
                                    </td>
                                </tr>

                                </tbody>
                                <!--<tfoot>
                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Engine version</th>
                                    <th>CSS grade</th>
                                </tr>
                                </tfoot>-->
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
</template>

<script>
    export default {
        name: "List",
        data(){
            return {
                categoryItem: [],
                select: '',
                allSelect: false,
            }
        },
        mounted(){
            this.$store.dispatch("allCategory")
        },
        computed: {
            getAllCategory(){
                return this.$store.getters.getCategory
            }
        },
        methods: {
            deleteSelected(){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })

                    .then((result) => {
                        if (result.value) {
                            axios.get('/deleteSelectedCategory/'+this.categoryItem)
                            this.$store.dispatch("allCategory")
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    })
                    .catch(()=>{

                    })
            },
            selectAll(){
                if (!this.allSelect){
                    this.allSelect = true
                    for (let category in this.getAllCategory){
                        this.categoryItem.push(this.getAllCategory[category].id)
                    }
                }
                else{
                    this.allSelect = false
                    this.categoryItem = []
                }
            },
            deleteCategory(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {
                    if (result.value) {
                        axios.get('/deleteCategory/'+id)
                        this.$store.dispatch("allCategory")
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                    this.categoryItem = []
                })

                    /*this.$store.dispatch("allCategory")
                    .then(()=>{
                        Toast.fire({
                            icon: 'success',
                            title: 'Category Deleted Successfully'
                        })
                    })
                        .catch(()=>{

                        })*/
            }
        }
    }
</script>

<style scoped>

</style>
