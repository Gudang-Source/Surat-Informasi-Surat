        @section('js')
            <script type="text/javascript">
                function readURL() {
                    var input = this;
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $(input).prev().attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }

                $(function () {
                    $(".uploads").change(readURL)
                    $("#f").submit(function(){
                        // do ajax submit or just classic form submit
                      //  alert("fake subminting")
                        return false
                    })
                })

            </script>
        @stop

        @extends('layouts.app')

        @section('content')


            {{ csrf_field() }}
            {{ method_field('put') }}
        <div class="row">
                    <div class="col-md-12 d-flex align-items-stretch grid-margin">
                      <div class="row flex-grow">
                        <div class="col-12">
                          <div class="card">
                        <div class="card-body">
							  <table class="col-md-12"> 
							  <tr>
							    <td width="200px;">Nomor Surat</td>
							     <td>:</td>
							    <td>{{ $data->nomor_surat }}</td>
							  </tr>
							  <tr>
							    <td>Sifat Surat</td>
							    <td>:</td>
							    <td>{{ $data->sifat_surat }}</td>
							  </tr>
							  <tr>
							    <td>Lampiran</td>
							    <td>:</td>
							    <td>{{ $data->lampiran }}</td>
							  </tr>
							  <tr>
							    <td>Hal</td>
							    <td>:</td>
							    <td>{{ $data->hal }}</td>
							  </tr>
							  <tr>
							    <td>Tujuan Surat</td>
							    <td>:</td>
							    <td>{{ $data->tujuan_surat }}</td>
							  </tr>
							  <tr>
							    <td>Tempat Tujuan</td>
							    <td>:</td>
							    <td>{{ $data->tempat_tujuan }}</td>
							  </tr>
                <tr>
                <td>Alamat Tujuan</td>
                <td>:</td>
                <td>{{ $data->alamat_tujuan }}</td>
                </tr>
                <br>
                  <tr>
                    <td>Isi Surat</td>
                    <td>:</td>
                    <td style="text-align: justify;">{{ $data->isi_surat }}</td>
                  </tr>
                  <tr>
                    <td>Tebusan</td>
                    <td>:</td>
                    <td>{{ $data->tebusan }}</td>
                  </tr>
                  <tr>
                    <td>Disposisi</td>
                    <td>:</td>
                    <td>{{ $data->disposisi }}</td>
                  </tr>
                  <tr>
                    <td>Pembuat Surat</td>
                    <td>:</td>
                    <td>{{ $data->pembuat_surat }}</td>
                  </tr>
                  <tr>
                    <td>Review Subag</td>
                    <td>:</td>
                    <td>{{ $data->review_subag }}</td>
                  </tr>
                  <tr>
                    <td>Review Kabag/Kabid</td>
                    <td>:</td>
                    <td>{{ $data->review_kabag }}</td>
                  </tr>
                  <tr>
                    <td>Review Kepala Balai</td>
                    <td>:</td>
                    <td>{{ $data->review_kepala_balai }}</td>
                  </tr>
                  @if($data->status=='Terima')
                  <tr>
                    <td style="color: green;">Status</td>
                    <td>:</td>
                    <td style="color: green;">{{ $data->status }}</td>
                  </tr>
                  @else
                  <tr>
                    <td style="color: red;">Status</td>
                    <td>:</td>
                    <td style="color: red;">{{ $data->status }}</td>
                  </tr>
                  @endif
				</tr>
			<tr>
		  </tr>
							</table>
                            <br>
                              <center>
                         @if(Auth::user()->level == 'Pj Evaluasi & Kehumasan' || Auth::user()->level == 'PjP2' || Auth::user()->level == 'PjP3' || Auth::user()->level == 'Pj Program & Kerja Sama' || Auth::user()->level == 'Pj Umum')

                         @if($data->status=='Terima' && $data->disposisi =='Kepala Bbksda')
                            <a href=" {{ url('/unduh', $data->id) }}" class="btn btn-success">Download Surat</a>
                        @endif
                            @endif
                        </center>
                         @if(Auth::user()->level != 'Pj Evaluasi & Kehumasan' && Auth::user()->level != 'PjP2' && Auth::user()->level != 'PjP3' && Auth::user()->level != 'Pj Program & Kerja Sama' && Auth::user()->level != 'Pj Umum')
                        <a href="{{ url('/review', $data->id) }}" class="btn btn-primary" id="submit">Proses</a>
                        @endif
                        <a href="{{route('suratkeluar.index')}}" class="btn btn-light pull-right">Back</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
        @endsection