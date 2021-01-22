@extends('template.template')

@section('head-section')
@endsection



@section('main')

    <div class="page-inner py-5">

        <!-- Page Header -->


        <div class="page-header">
            <h4 class="page-title">Manage Agenda</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Admin</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Agenda</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Manage</a>
                </li>
            </ul>
        </div>

        <div class="row mt--2">
            <div class="row center col-12">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-chart-pie text-warning"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Total Agenda</p>
                                        <h4 class="card-title">0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-check text-success"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Siswa<br>Ikhwan</p>
                                        <h4 class="card-title">0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-check text-success"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Siswa<br>Ikhwan</p>
                                        <h4 class="card-title">0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5">
                                    <div class="icon-big text-center">
                                        <i class="flaticon-error text-danger"></i>
                                    </div>
                                </div>
                                <div class="col-7 col-stats">
                                    <div class="numbers">
                                        <p class="card-category">Siswa <br> Akhwat</p>
                                        <h4 class="card-title">4</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card border-primary">
       
        <div class="card-body">
            <a href="{{url('admin/agenda/create')}}">
                <button class="btn btn-primary btn-border btn-round mb-3">
                    Buat Agenda Baru</button>
            </a>
          
            <div class="table-responsive">
                <table id="basic-datatables" class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul Agenda</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Mulai</th>
                            <th scope="col">Selesai</th>
                            <th scope="col">Tanggal Dibuat</th>
                            <th scope="col">Tanggal Diupdate</th>
                            <th scope="col">Edit</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dayta as $data)

                            <div class="modal fade" id="updateModal{{ $loop->iteration }}" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalCenterTitle">Update
                                                Data Agenda</h5>

                                               
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('admin/agenda/edit') }}" method="post">
                                                @csrf
                                                @method('POST')

                                                <input type="hidden" name="id" value="{{$data->id}}">
                                            <div class="form-group">
                                                <label for="">Judul Agenda</label>
                                                <input type="text"
                                                  class="form-control" name="u_title" id="" value="{{$data->title}}" placeholder="Judul Agenda">
                                              </div>
                                              <div class="form-group">
                                                <label for="">Jenis Agenda</label>
                                                <select class="form-control" name="u_type" id="">
                                                  <option value="1" 
                                                  @if ($data->type==1)
                                                      selected
                                                  @endif
                                                  >Halaqoh Tahfidz SMP</option>
                                                  <option value="2"
                                                  @if ($data->type==2)
                                                  selected
                                                  @endif
                                                  >Halaqoh Tahfidz SMA</option>
                                                  <option value="3"
                                                  @if ($data->type==3)
                                                  selected
                                                  @endif>Halaqoh Tahfidz SD</option>
                                                  <option
                                                  @if ($data->type==4)
                                                  selected
                                                  @endif
                                                  value="4">Ujian</option>
                                                </select>
                                              </div>

                                              <div class="form-group">
                                                <label>Waktu Mulai</label>
                                                <div class="input-group">
                                                    <input type="datetime-local" value="{{ date("Y-m-d\TH:i:s", strtotime($data->start))}}" class="form-control" id="datetime" name="u_start">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Waktu Selesai</label>
                                                <div class="input-group">
                                                    <input type="datetime-local" value="{{ date("Y-m-d\TH:i:s", strtotime($data->end))}}" class="form-control" id="datetime" name="u_end">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Deskripsi Agenda</label>
                                                <textarea class="form-control" name="u_description" id="" rows="3">{{$data->description}}</textarea>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary">Update</button>
                                              <button type="reset" class="btn btn-danger">Reset</button>
                                            </form>
                                        </div>


                                    </div>
                                </div>
                            </div>


                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->title}}</td>
                                <td>
                                    <span class="badge badge-primary">
                                   @php
                                       $type = $data->type;
                                   @endphp 
                                    @if ($type==1)
                                    Halaqoh Tahfidz SMP
                                    @endif
                                    @if ($type==2)
                                    Halaqoh Tahfidz SMA
                                    @endif
                                    @if ($type==3)
                                    Halaqoh Tahfidz SD
                                    @endif
                                    @if ($type==4)
                                    Ujian
                                    @endif
                                </span>
                                  </td>
                                <td>
                                    <span class="badge badge-success">
                                        {{$data->start}}
                                    </span>
                                  </td>
                                <td>  
                                <span class="badge badge-warning">
                                    {{$data->end}}
                                </span>
                                </td>
                                <td><span class="badge">
                                {{$data->created_at}}    
                                </span>
                                </td>
                                <td>
                                <span class="badge">
                                    {{$data->updated_at}}    
                                </span>
                                </td>
                                <td class="">
                                        <button type="button" title="" class="btn btn-link btn-primary btn-lg"
                                        data-toggle="modal" data-target="#updateModal{{$loop->iteration}}"
                                        data-original-title="Edit Agenda">
                                        <i class="fa fa-edit"></i>
                                      </button>

                                      <form
                                      action="{{ url('/admin/agenda/delete') }}" method="POST">
                                      @csrf
                                      @method('POST')
                                      <input type="hidden" name="id" value="{{$data->id}}">
                                      <button type="submit" type="submit" class="btn btn-link btn-danger btn-lg"
                                        data-toggle="modal"  onclick="return confirm('Apakah Anda Yakin ? Ini Akan Menghapus Absensi Yang Sudah Diinput')"
                                        data-original-title="Hapus Agenda">
                                        <i class="fa
                                        fas fa-trash-alt"></i>
                                      </button>
                                    </form>
                                     
                                </td>



                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Agenda belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    </div>



@endsection

@section('script')


	<!-- DateTimePicker -->
	<script src="{{asset('atlantis/examples')}}/assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>
    {{-- Toastr --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Datatables -->
    <script src="{{asset('atlantis/examples')}}/assets/js/plugin/datatables/datatables.min.js"></script>
{{-- Toastr --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Datatables -->
    <script src="{{asset('atlantis/examples')}}/assets/js/plugin/datatables/datatables.min.js"></script>
   
    <script>
        $(document).ready(function() {
            var table = $('#datatables').DataTable( {
            // dom: '<"bottom"i>rt<"top"flp><"clear">',
            dom: 'T<"clear">lfrtip<"bottom"B>',
            // "scrollY": "1000px",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "bPaginate": true,
            "lengthChange": true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
            });
            $(".v-filter").click(function(){
            var column = table.column( $(this).attr('data-column') );
            column.visible( ! column.visible() );
            });
            $('a.toggle-v').on( 'click', function (e) {
            e.preventDefault();
            column.visible( ! column.visible() );
        } );
        });
    </script>


    <script>
        //message with toastr
                @if(session()-> has('success'))
                    toastr.success('{{ session('success') }}', 'BERHASIL!'); 
                @elseif(session()-> has('error'))
                    toastr.error('{{ session('error') }}', 'GAGAL!'); 
                @endif

                $(document).ready(function() {
            $('#basic-datatables').DataTable({
            });
        });
    </script>
    
    
@endsection
