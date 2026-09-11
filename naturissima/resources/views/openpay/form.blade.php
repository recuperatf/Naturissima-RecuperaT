<!-- Button trigger modal -->

<!-- Modal -->
<script type="text/javascript">
    $(function(){
        en_dis_facturacion($("#btn_en_dis_facturacion"));
        $("#btn_en_dis_facturacion").click(function(event){
            event.preventDefault();
            event.stopPropagation();
            en_dis_facturacion($(this));
        });
    });
    function en_dis_facturacion(button,enabled=false){
        first_children=$("#div_facturation_data").children("input,select").first();
        if(first_children.attr("disabled")=="disabled" || enabled==true){
            $("#div_facturation_data").children("input,select").removeAttr("disabled");
            $(button).html("No requiero facturación");
        }else{
            $(button).html("Requiero facturación");
            $("#div_facturation_data").children("input,select").attr("disabled","true");
        }
    }
    function preventNonNumericalInput(input) {
      string=$(input).val();
      charStr=string[string.length-1];
      if(charStr.match(/^[0-9]+$/)==undefined){
        $(input).val($(input).val().substring(0,($(input).val().length-1)));
      }
    }
</script>
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content px-10">

        <div class="modal-body">

            <div class="d-inline-flex mx-auto mt-3">
                @csrf
                <input type="hidden" name="token_id" id="token_id">
                <div id="div_facturation_data" class="modal_checkout_page" style="margin-bottom: 50px;">
                    <h2>Datos de facturación</h2>
                    <h5>(Si no requiere facturación, no es necesario llenar)</h5>
                    <h6>(Si tu compra tiene envío a domicilio -compra mínima $1,000 para envíos locales y $2,500 para envíos nacionales-, lo llenarás en la siguiente ventana)</h6>
                    <br>
                    <button class="btn primary" id="btn_en_dis_facturacion" style="background-color: green; color: white;">Requiero Facturación</button>
                    <br>
                    <label>Código Postal</label>
                    <input type="number" class="form-control" placeholder="Codigo Postal" id="postal_code_facturation" name="postal_code_facturation" select_state_id="#select_state_facturation">
                    <label>Nombre o Razón social</label>
                    <input type="text" class="form-control" placeholder="Nombre o Razón social" id="name_facturation" name="name_facturation">
                    <label>Estado</label>
                    <select class="form-control" id="select_state_facturation" name="state_facturation" select_municipality_id="#municipality_facturation">
                        <option value="33" selected>Seleccione un estado</option>
                        @foreach($states as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option>
                        @endforeach
                    </select>
                    <label>Municipio</label>
                    <select class="form-control" id="municipality_facturation" name="municipality_facturation">
                        <option value="1" selected>Seleccione un municipio</option>
                    </select>
                    <label>Calle y número</label>
                    <input type="text" class="form-control" placeholder="Calle y #numero" id="street_and_number_facturacion" name="street_and_number_facturacion">
                    <div class="d-flex mt-5 mb-5">
                        <a class="btn btn-primary mx-auto" style="color: white" next_page="{{isset($minimum_checkout)?'#div_choose_envío':'div_facturation_data'}}" onclick="gotoPage(event)">Siguiente</a>
                    </div>
                </div>
                <div id="div_choose_envío" class="modal_checkout_page" style="margin-bottom: 50px; display: none" no-show="{{!empty($disable_div_choose_envío)?$disable_div_choose_envío['next']:0}}">
                    <h2>Escoge una forma de recibirlo</h2>
                    {{-- <p id="minimum-buy-warning" class="alert alert-warning" style="display: none">{{(isset($minimum_checkout))?(""):''}}</p> --}}
                    <label>Envío a domicilio</label>
                    <input type="checkbox" class="delivery" next_page="#div_send_address_data" onclick="gotoPage(event)"  target="#delivery" value=true>
                    <input type="hidden" class="delivery_pickup" name="delivery" id="delivery" value=1 {{isset($disable_div_choose_envío)?'':'disabled'}}>
                    <label>Recoger en tienda</label>
                    <input type="checkbox" next_page="#div_credit_card_data" onclick="gotoPage(event)" target="#store_pickup" value=true>
                    <input type="hidden" class="delivery_pickup"  name="store_pickup" id="store_pickup" value=1 disabled>
                    <div>
                        <a class="btn btn-primary mx-auto" style="color: white" next_page="#div_facturation_data" onclick="gotoPage(event)">Atras</a>
                    </div>
                </div>
                <div id="div_send_address_data" class="modal_checkout_page" style="margin: 10px 30px 50px 30px; display: none;">
                    <h2>Direccion de envío/entrega a domicilio</h2>
                    <label>Código Postal</label>
                    <input type="number" class="form-control" placeholder="Codigo Postal" id="postal_code_send_address" name="postal_code_send_address" select_state_id="#select_state_send_address">
                    <label>Nombre del receptor</label>
                    <input type="text" class="form-control" placeholder="Nombre" id="name_send_address" name="name_send_address">
                    <label>Estado</label>
                    <select class="form-control" id="select_state_send_address" name="state_send_address" select_municipality_id="#municipality_send_address">
                        <option value="33">Seleccione un estado</option>
                        <option value="14" selected>Jalisco</option>
                        @foreach($states as $state)
                        <option value="{{$state->id}}">{{$state->name}}</option>
                        @endforeach
                    </select>
                    <label>Municipio</label>
                    <select class="form-control" id="municipality_send_address" name="municipality_send_address">
                        <option value="120" selected>Zapopan</option>
                    </select>
                    <label>Calle y número</label>
                    <input type="text" class="form-control" placeholder="Calle y #numero" id="street_and_number_send_address" name="street_and_number_send_adress">
                    <div id ="map"></div>
                    <div class="d-flex mt-5 mb-5">
                        <a class="btn btn-primary mx-auto" style="color: white" next_page="{{isset($disable_div_choose_envío)?'#div_choose_envío':'#div_choose_envío'}}" onclick="gotoPage(event)">Atras</a>
                        <a class="btn btn-primary mx-auto" style="color: white" next_page="#div_credit_card_data" onclick="gotoPage(event)">Siguiente</a>
                    </div>
                </div>
                <div id="div_credit_card_data" class="modal_checkout_page" style="display: none">
                    <h2>Pago en linea</h2>
                    <h4>Tarjeta de débito o crédito</h4>
                    <div class="d-flex flex-row" style=>
                        <div class="w-50" style="text-align: center">
                            <i class=" fab fa-cc-visa fa-5x"></i>
                        </div>
                        <div class="w-50" style="text-align: center">
                            <i class="mx-auto fab fa-cc-mastercard fa-5x"></i>
                        </div>
                    </div>
                    <label>Nombre del titular</label>
                    <input type="text" name="buyer_name" class="form-control" placeholder="Como aparece en la tarjeta" autocomplete="off" data-openpay-card="holder_name">
                    <label>Teléfono</label>
                    <input type="tel" id="telephone_card" name="card_telephone" placeholder="(33)3333-3333" class="form-control">
                    <label>E-mail</label>
                    <input type="email" id="card_email" name="card_email" placeholder="ejemplo@ejemplo.ej" class="form-control"/>
                    <label>Número de tarjeta</label>
                    <input class="form-control" class="buyer_card"  type="text" autocomplete="off" data-openpay-card="card_number" id="card_number" maxlength="16" oninput="preventNonNumericalInput(this)"/>
                    <div class="w-100">
                        <label>Fecha de expiración</label>
                    </div>
                    <div class="d-flex flex-row w-100">
                        <div class="w-50"><input name="buyer_expire_month" class="form-control" type="text" placeholder="MM" data-openpay-card="expiration_month" maxlength="2" oninput="preventNonNumericalInput(this)"></div>
                        <div class="w-50"><input class="form-control" name="buyer_expire_year" type="text" placeholder="YY" data-openpay-card="expiration_year" maxlength = "2"
                        oninput="preventNonNumericalInput(this)"></div>
                    </div>
                    <label>Código de seguridad</label>
                    <div class="">
                        <input type="password" name="buyer_security_code" placeholder="Verificación" autocomplete="off" data-openpay-card="cvv2" class="form-control" maxlength="4">
                    </div>
                    <div>
                        <div class="avisos">
                            @include('legal/modal_terminos_y_condiciones')
                        </div>
                    </div>
                    <div class="d-flex mt-5 mb-5">
                        <a class="btn btn-primary mx-auto" style="color: white" next_page="#div_facturation_data" onclick="gotoPage(event)">Atras</a>
                        <button class="btn btn-primary mx-auto" id="pay-button" style="color: white">Pagar!</button>
                    </div>
                </div>


            </div>
        </div>
        <div class="modal-footer">
            <img style="height: 25px;width:100px"  src="{{'images/openpay_logo.png'}}">
        </div>
    </div>
</div>
</div>
