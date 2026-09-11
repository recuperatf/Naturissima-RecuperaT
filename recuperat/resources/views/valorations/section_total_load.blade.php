<div class="row">
    <div class="col">
        <h3>{{$label}}</h3>
        <p>Resumen del valor obtenido en cada uno de los factores analizados</p>
    </div>
    <div class="col-12">
        <p>{{$description}}</p>
    </div>
    <div class="col-lg-12">
        <table class="table" assigned-total = "{{$total_label}}">
            <tr>
                <th>Factor de riesgo</th>
                <th>Color</th>
                <th>Valor</th>
            </tr>
            <tr class = "tr_total">
                <td>Total</td>
                <td id = "{{$total_label}}"></td>
                <td></td>
            </tr>
        </table>
    </div>
</div>
<div class="row">