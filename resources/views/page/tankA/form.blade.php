@extends('adminlte::page')

@section('title', 'Tank-App | Tangki 51 - 58')

@section('content_header')
<h1 class="m-0 text-dark">Tangki 51 - 58</h1>
@stop

@section('content')
<div class="row">
  <div class="col-md-6" `>
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title"><b>Input Pengukuran</b></h3>
      </div>
      <form id="calculateForm">
        @csrf
        <div class="card-body">
          <label for="category_id">Pilih Nomor Tangki</label>
          <select class="form-control" id="type_of_tank" name="type_of_tank" required>
            <option value="" disabled selected>Pilih Nomor Tangki</option>
            @foreach($m_tank as $item)
            <option value="{{ $item->type_of_tank }}">{{ $item->tank_identity_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="card-body">
          <label for="category_id">Pilih Isi Tangki</label>
          <select class="form-control" id="sg" name="sg" required>
            <option value="" disabled selected>Pilih Isi Tangki</option>
            @foreach($m_sg as $item)
            <option value="{{ $item->sg }}">{{ $item->item }}</option>
            @endforeach
          </select>
        </div>
        <div class="card-body">
          <label for="exampleInputEmail1">Input Sounding (cm)</label>
          <input type="number" step="0.01" class="form-control" id="sounding" name="sounding" placeholder="Sounding (cm)" required>
        </div>

        <div class="card-footer">
          <button id="calculateBtn" type="submit" class="btn btn-primary">Calculate</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Result Table -->
  <div class="col-md-6">
    <div id="resultTable" style="display:none;" class="card card-primary">
      <div class="card-header">
        <h3 class="card-title"><b>Calculation Result</b></h3>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <tbody>
            <tr>
              <th>Rumus</th>
              <td id="rumus"></td>
            </tr>
            <tr>
              <th>Selisih</th>
              <td id="selisih"></td>
            </tr>
            <tr>
              <th>Hasil</th>
              <td id="hasil"></td>
            </tr>
            <tr>
              <th>Hasil Akhir</th>
              <td>
                <span id="final_result"></span>
                <i id="copyBtn" class="fas fa-copy" style="cursor:pointer; margin-left: 20px;" title="Copy"></i>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@stop

@section('js')
<script>
  $(document).ready(function() {
    $('#calculateForm').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        url: "{{ route('tankA.calculate') }}",
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          $('#rumus').text(response?.data?.rumus);
          $('#selisih').text(response?.data?.selisih);
          $('#hasil').text(response?.data?.hasil);
          $('#final_result').text(response?.data?.final_result);
          $('#resultTable').show();
          $('input, select').attr('disabled', true);
          $('#calculateBtn').text('Reset').attr('id', 'resetBtn');
        },
        error: function(xhr) {
          alert('An error occurred while calculating the results.');
        }
      });
    });
  });

  $(document).on('click', '#resetBtn', function(e) {
    e.preventDefault();
    $('#resultTable').hide();
    $('input, select').attr('disabled', false);
    $('#calculateForm')[0].reset();
    $(this).text('Calculate').attr('id', 'calculateBtn');
  });

  $('#copyBtn').on('click', function() {
    let finalResult = $('#final_result').text();
    navigator.clipboard.writeText(finalResult);
  });
</script>
@stop