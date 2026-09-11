@extends('layouts.basic_client')
@section('content')
  <script>
    $(() => {
      btn_terms=$("#btn_terms")
      btn_terms.click(addTerm)
      $("form").one('submit', (e) => {
        e.preventDefault();
        reorderTerms();
        $(e.target).submit();
      })
      addTerm()
    })
    function addTerm() {
      const search_row_template = $("#search_row_template")
      let clone = $("#search_row_template").clone()
      clone.attr("id", "")
      let select = clone.find('select').first()
      select.attr('name', 'search[{number}][where]')
      let term = clone.find('.term').first()
      term.attr('name', 'search[{number}][term]')
      clone.toggleClass("d-none")
      clone.insertAfter(search_row_template)
      clone.find(".delete").click(deleteTerm)
    }

    function deleteTerm(event) {
      button = $(event.target)
      button.closest(".search_row").remove()
    }

    function reorderTerms() {
      $(".search_row:not(.d-none)").each( (rowCont, row) => {
        row = $(row)
        row.find("select,input").each((cont, tag) => {
          oldName = $(tag).attr("name")
          newName = oldName.replace("{number}", rowCont)
          $(tag).attr("name", newName)
        })
      })
    }
  </script>
    <div class="container">
      <form action="{{route('documental_search.index')}}" id="form" method="GET">
        <div class="row vertical-center-row">
          <div class="col-lg-12 mt-1">
            <img src="/images/fisioaleph.jpg" alt="" width="100px" height="auto">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="col-lg-12">
              <h2>Búsqueda documental</h2>
            </div>
          </div>
        </div>
        <div id="search_row_template" class="row d-none search_row">
          <div class="col-md-6">
            <input type="text" class="form-control term" placeholder="Búsqueda">
          </div>
          <div class="col-md-4">
            <select class="form-control" placeholder="Búsqueda">
              <option value="name">Título</option>
              <option value="abstract">Resumen</option>
              <option value="author">Autor</option>
            </select>
          </div>
          <div class="col-md-2">
            <button class="btn btn-danger delete">Eliminar</button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <button id="btn_terms" type="button" class="btn btn-primary">+ Términos</button>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-md-6">
            <input type="submit" id="submitFrom" class="btn btn-primary" value="Buscar">
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col-lg-12">
          <table class="table table-responsive">
            <th>Nombre</th>
            @foreach($resultsArray as $type => $resultRow)
              <tr>
                <td><a target="_blank" href="https://biblioteca.fisioaleph.com/xmlui/{{$resultRow->handle}}">{{$resultRow->name}}</a></td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
@endsection
