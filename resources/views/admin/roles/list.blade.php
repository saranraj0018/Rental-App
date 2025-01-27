@extends('admin.layout.app')

@section('content')

    <!-- Content Header (Page header) -->
    <style>
        svg.w-5.h-5{
            height:20px;
            width:20px;
        }
        p.text-sm.text-gray-700.leading-5.dark\:text-gray-400{
            margin:30px 0;
            text-align:center;
        }
        a.relative.inline-flex.items-center.px-4.py-2.ml-3.text-sm.font-medium.text-gray-700.bg-white.border.border-gray-300.leading-5.rounded-md.hover\:text-gray-500.focus\:outline-none.focus\:ring.ring-gray-300.focus\:border-blue-300.active\:bg-gray-100.active\:text-gray-700.transition.ease-in-out.duration-150.dark\:bg-gray-800.dark\:border-gray-600.dark\:text-gray-300.dark\:focus\:border-blue-700.dark\:active\:bg-gray-700.dark\:active\:text-gray-300{
            margin-left:50px !important;
        }
    </style>
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>User Role</h1>
                </div>
                @if(in_array('roles_create',$permissions))
                    <div class="col-sm-6 text-right">
                        <button class="btn btn-primary mb-3" id="add_role">Add Role</button>
                    </div>
                @endif
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content" x-data="{

        deletionId: null,

        async deleteUser() {
            $('#delete_user_confrim_modal').modal('hide')

            try {
                const response = axios.post('{{ route('delete.user') }}', {
                    userId: this.deletionId
                });


                $('#delete_user_modal').modal('show')

                setTimeout(() => {
                    window.location.reload()
                }, 3000)

            } catch (error) {
                console.log(error)
                $('#delete_user_confrim_modal').modal('hide')
                $('#delete_user_error_modal').modal('show')
            }
        }


    }">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table id="role_table" class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Info</th>
                            <th>User Role</th>
                            <th>Email</th>
                            <th>Create At</th>
                            <th>Action </th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(filled($user_role))
                            @foreach($user_role as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td><button  data-toggle="modal" data-target="#user_{{ $item->id }}" class="btn"><i class="fa fa-eye"></i></button></td>
                                    <td>{{ $item->user_role }}</td>
                                    <td>{{ $item->user->email ?? '' }}</td>
                                    <td>{{ showDateTime($item->updated_at) }}</td>
                                    <td>
                                        <!--&& $item->id !== 1-->
                                        @if(in_array('roles_update',$permissions) )
                                            <a href="javascript:void(0)" class="role_edit" data-id="{{ $item->id }}"  data-role="{{ $item->user_role }}" data-user_permission="{{ $item->permissions }}">
                                                <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                                </svg>
                                            </a>
                                            @if(in_array('roles_delete',$permissions) && $item->users->count() == 0)
                                                <a href="#" class="role_delete text-danger w-4 h-4 mr-1"  data-id="{{ $item->id }}">
                                                    <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </a>
                                            @endif
                                        @endif
                                    </td>

                                <div class="modal fade" id="user_{{ $item->id }}">
                                    <div class="modal-dialog" style="min-width: 900px">
                                        <div class="modal-content" >
                                            <div class="modal-header">
                                                <h4>Users in this Role</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="w-100">
                                                    <div class="d-flex justify-content-between align-items-center px-2" style="background: rgb(200, 200, 200); border-radius: 7px; height: fit-content;">
                                                        <span style="font-weight: 600; font-size: .9em; text-transform: uppercase; color: #000" class="p-3 w-25">S.No</span>
                                                        <span style="font-weight: 600; font-size: .9em; text-transform: uppercase; color: #000" class="p-3 w-100">Email</span>
                                                        <span style="font-weight: 600; font-size: .9em; text-transform: uppercase; color: #000" class="p-3 w-100">User Name</span>
                                                        <span style="font-weight: 600; font-size: .9em; text-transform: uppercase; color: #000" class="p-3 w-100">Created At</span>
                                                        <span style="font-weight: 600; font-size: .9em; text-transform: uppercase; color: #000" class="p-3 w-100">Action</span>
                                                    </div>
                                                    @forelse ($item->users as $user)
                                                    <div x-data="{

                                                        password: null,
                                                        passwordError: false,
                                                        loading: false,

                                                        async savePassword() {
                                                            this.passwordError = false

                                                            if(!this.password) {
                                                                this.passwordError = true
                                                                return false
                                                            };

                                                            this.loading = true

                                                            try {
                                                                const response = axios.post('{{ route('update.password') }}', {
                                                                    password: this.password,
                                                                    userId: '{{ $user->id }}'
                                                                });

                                                                this.loading = false

                                                                $('#reload_page_model').modal('show')

                                                                setTimeout(() => {
                                                                    window.location.reload()
                                                                }, 3000)

                                                            } catch (error) {
                                                                this.loading = false
                                                                this.passwordError = true
                                                            }
                                                        },


                                                    }" class="d-flex justify-content-between align-items-center px-2" style="height: fit-content; border-bottom: 1px solid rgb(200, 200, 200);">
                                                        <span style="font-size: .9em; color: #000; overflow: hidden;" class="px-3 py-2 w-25">{{ $user->id }}</span>
                                                        <span style="font-size: .9em; color: #000; overflow: hidden;" class="px-3 py-2 w-100 text-center">{{ $user->email }}</span>
                                                        <span style="font-size: .9em; color: #000; overflow: hidden;" class="px-3 py-2 w-100">{{ $user->user_name }}</span>
                                                        <span style="font-size: .9em; color: #000; overflow: hidden;" class="px-3 py-2 w-100">{{ $user->created_at }}</span>
                                                        <span style="font-size: .9em; color: #000; overflow: hidden;" class="px-3 py-2 w-100 d-flex justify-content-start">
                                                            <span  class="d-flex justify-content-start" style="border: 1px solid #7f7f7f8c; width: 90%" :style="passwordError ? 'border: 1px solid red; width: 90%; color: red' : 'border: 1px solid #7f7f7f8c; width: 90%'">
                                                                <input type="password" style="width: 80%; background-color: transparent; outline: none; border: none; padding: .5em 1em; width: 80%;" x-model="password" placeholder="*******">
                                                                <button :disabled="loading" @click.prevent="savePassword" class="btn btn-sm" type="submit" style="width: 20%"><i class="fas fa-check"></i></button>
                                                            </span>
                                                            <button @click="() => {
                                                                $('#delete_user_confrim_modal').modal('show');
                                                                deletionId = '{{ $user->id }}'
                                                            }" class="btn btn-sm text-danger" style="width: 10%;"><i class="fas fa-trash"></i></button>
                                                        </span>
                                                </div>


                                                    @empty
                                                    <div class="d-flex justify-content-between align-items-center px-2" style="height: fit-content; border-bottom: 1px solid rgb(200, 200, 200);">
                                                        <span style="font-size: .9em; color: #000; overflow: hidden;" class="px-3 py-2 w-25">No users found for this role</span>
                                                    </div>
                                                    @endforelse
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-danger" data-dismiss="modal"><span>Close</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>

                            @endforeach
                        @else
                            <tr>
                                <td colspan="5"> Record Not Found</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="d-flex justify-content-end w-100 mt-t pt-5 pagination" id="pagination">
                                {{ $user_role->links() }}
            </div>
        </div>



        <div class="modal fade" id="reload_page_model" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Password</h5>
                    </div>
                    <div class="modal-body">
                        <span><i class="fas fa-check text-success"></i> Password Updated Successfully</span>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="delete_user_modal" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Deletion</h5>
                    </div>
                    <div class="modal-body">
                        <span><i class="fas fa-check text-success"></i> User Deleted Succesfully</span>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="delete_user_error_modal" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Deletion</h5>
                    </div>
                    <div class="modal-body">
                        <span><i class="fas fa-close text-danger"></i>Something went wrong, please try again</span>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="delete_user_confrim_modal" >
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Deletion</h5>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure? you want to delete this user</p>
                    </div>

                    <div class="modal-footer">
                        <button @click="deleteUser" class="btn btn-danger"><i class="fas fa-trash"></i> Delete User</button>
                        <button class="btn btn-secondary" data-bs-dismiss="modal" data-dismiss="modal"><i class="fas fa-close"></i> Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.roles.model')
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
@section('customJs')
    <script src="{{asset("admin/js/user-role.js")}}"></script>
@endsection
