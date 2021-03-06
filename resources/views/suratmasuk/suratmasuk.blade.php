    @section('js')
    <script type="text/javascript">
      $(document).ready(function() {
        $('#table').DataTable({
          "iDisplayLength": 10
        });

      } );
    </script>
    
    @stop
    @extends('layouts.app')

    @section('content')
    <div class="row">
       @if(Auth::user()->level == 'Sekretaris')
      <div class="col-lg-2">
        <a href="{{ route('suratmasuk.create') }}" class="btn btn-primary btn-rounded btn-fw"><i class="fa fa-plus"></i> Tambah Surat Masuk</a>
      </div>
      @endif
      <div class="col-lg-12">
        @if (Session::has('message'))
        <div class="alert alert-{{ Session::get('message_type') }}" id="waktu2" style="margin-top:10px;">{{ Session::get('message') }}</div>
        @endif
      </div>
    </div>
    <div class="row" style="margin-top: 20px;">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">

          <div class="card-body">
            <h4 class="card-title">Data Surat Masuk</h4>

            <div class="table-responsive">
              <table id="table" class="table table-striped">
                <thead>
                  <tr>
                    <th>
                      Nama Instansi
                    </th>
                    <th>
                      No Surat
                    </th>
                    <th>
                      Disposisi
                    </th>
                    <th>
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($datas as $data)
                    <?php 
                      if (Auth::user()->level == $data->disposisi || Auth::user()->level.' '.Auth::user()->name == $data->disposisi  || Auth::user()->level=='Sekretaris') {
                     ?>
                  <tr>
                    <td>{{$data->nama_instansi}}</td>
                    <td>{{$data->no_surat}}</td>
                    @if(Auth::user()->level =='PjP2' || Auth::user()->level =='PjP3' || Auth::user()->level =='Pj Evaluasi & Kehumasan' || Auth::user()->level =='Pj Program & Kerja Sama' || Auth::user()->level =='Pj Umum')
                    <td>{{$data->disposisi}}</td>
                    @else
                    <td><a href="{{ url('/dispo', $data->id) }}">{{$data->disposisi}}</a></td>
                    @endif
                    <td>
                      @if(Auth::user()->level == 'Kepala Bbksda' || Auth::user()->level == 'Sekretaris')
                      <button><a href="{{route('suratmasuk.edit', $data->id)}}" title="edit"><i class="fa fa-edit btn btn-primary"></i></a></button>
                      <form action="{{ route('suratmasuk.destroy', $data->id) }}" class="pull-left"  method="post">
                        {{ csrf_field() }}
                        {{ method_field('delete') }}
                        <button onclick="return confirm('Anda yakin ingin menghapus data ini?')"> <i class="fa fa-trash btn btn-danger"  title="hapus"></i>
                        </button>
                      </form>
                      @endif
                      <button><a href="{{route('suratmasuk.show', $data->id)}}" title="detail"><i class="fa fa-search-plus btn btn-success"></i></a></button>
                    </td>
                  </tr>
                  <?php
                }
                  ?>
                  @endforeach
                </tbody>
              </table>
            </div>
            {{-- {!! $datas->links() !!} --}}
          </div>
        </div>
      </div>
    </div>
    @endsection