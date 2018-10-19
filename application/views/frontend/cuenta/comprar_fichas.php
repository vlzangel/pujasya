<div class="container">
  <div class="col-md-12 mt-30 creditos">
    <div class="panel p-20">
      
<form id="regForm" action="">

  <div class="pasos">

    <div class="step text-center">
      <div class="m1">1</div>
      <p class="m2">Cantidad de Pujas</p>
    </div>

     <div class="step text-center">
      <div class="m1">2</div>
      <p class="m2">Pago</p>
    </div>

     <div class="step text-center">
      <div class="m1">3</div>
      <p class="m2">Comenzar a Pujar</p>
    </div>
  </div>

  <div class="tab-form-fich dest">
      <h3 class="bold1">Selecciona un Paquete de Fichas</h3>
    <hr>

    <div class="col-md-12 text-center mb-20">
       <div class="row ">
        <div class="col-md-2 col-sm-4 col-xs-12 card-credit borcar" id="paq1">
          <a href="#" onclick="selectpaquete(1);">
            <div class="col-md-6 text-left splr pb-5">
              <h6 class="bold1">X-SMALL</h6>
            </div>
            <div class="col-md-6 text-right splr pb-5">
              <h6 class="bold1 cg1">10€</h6>
            </div>
            <img class="img-responsive" src="<?= base_url()?>public/assets/images/creditos/creditos.png?v1" alt="">
            <p class="p1">100 Fichas</p>
          </a>
        </div>

        <div class="col-md-2 col-sm-4 col-xs-12 card-credit borcar" id="paq2">
          <a href="#" onclick="selectpaquete(2);">
            <div class="col-md-6 text-left splr pb-5">
              <h6 class="bold1">X-SMALL</h6>
            </div>
            <div class="col-md-6 text-right splr pb-5">
              <h6 class="bold1 cg1">10€</h6>
            </div>
            <img class="img-responsive" src="<?= base_url()?>public/assets/images/creditos/creditos.png?v1" alt="">
            <p class="p1">100 Fichas</p>
          </a>
        </div>

        <div class="col-md-2 col-sm-4 col-xs-12 card-credit borcar active-credit p-10 mlr-1p mb-20 " id="paq3">
          <a href="#" onclick="selectpaquete(3);">
            <div class="col-md-6 text-left splr pb-5">
              <h6 class="bold1">X-SMALL</h6>
            </div>
            <div class="col-md-6 text-right splr pb-5">
              <h6 class="bold1 cg1">10€</h6>
            </div>
            <img class="img-responsive" src="<?= base_url()?>public/assets/images/creditos/creditos.png?v1" alt="">
            <p class="p1">100 Fichas</p>
          </a>
        </div>

        <div class="col-md-2 col-sm-4 col-xs-12 card-credit borcar" id="paq4">
          <a href="#" onclick="selectpaquete(4);">
            <div class="col-md-6 text-left splr pb-5">
              <h6 class="bold1">X-SMALL</h6>
            </div>
            <div class="col-md-6 text-right splr pb-5">
              <h6 class="bold1 cg1">10€</h6>
            </div>
            <img class="img-responsive" src="<?= base_url()?>public/assets/images/creditos/creditos.png?v1" alt="">
            <p class="p1">100 Fichas</p>
          </a>
        </div>

        <div class="col-md-2 col-sm-4 col-xs-12 card-credit borcar" id="paq5">
          <a href="#" onclick="selectpaquete(5);">
            <div class="col-md-6 text-left splr pb-5">
              <h6 class="bold1">X-SMALL</h6>
            </div>
            <div class="col-md-6 text-right splr pb-5">
              <h6 class="bold1 cg1">10€</h6>
            </div>
            <img class="img-responsive" src="<?= base_url()?>public/assets/images/creditos/creditos.png?v1" alt="">
            <p class="p1">100 Fichas</p>
          </a>
        </div>
       
      </div>
    </div>

    <div class="row slmr0">
      <h5 class="bold1">Resumen del Pedido</h5>
      <hr class="mb-0">

      <div class="col-md-8">
        <div class="row fila">
           <div class="col-md-9 col-sm-9 col-xs-9  text-left">
          <p class="p1">X-SMALL: 100 Fichas</p>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-3 text-right">
            <p class="p1">10€</p>
          </div>
        </div>
        
        <div class="row fila f2">
           <div class="col-md-9 col-sm-9 col-xs-9 text-left">
            <h5 class="bold1">Total</h5>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-3 text-right">
            <h5 class="bold1">10€</h5>
          </div>
        </div>
      </div>

      <div class="col-md-4 mt-20">

        <div class="input-group">
          <input type="text" class="form-control" placeholder="Código de Promoción ">
          <span class="input-group-btn">
            <button class="btn btn-usar" type="button">Usar</button>
          </span>
        </div>
        <p class="text-muted newp">Opcional</p>
      </div>
      </div>

      <div class="text-right mt-20">
        <!-- <input type="hidden" required="" id="idpaquete" name="idpaquete"> -->     

        <button class="btn btn-sm" type="button" id="nextBtn" onclick="nextPrev(1)">Selecciona Método de Pago
        </button>
      </div>
  </div>


  <div class="tab-form-fich dest">
    <h3 class="bold1">Selecciona un Método de Pago</h3>
    <hr>

    <div class="col-md-12 text-center mb-20">
     <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12  ">
        <div class="col-md-offset-3 col-md-3 col-sm-6 col-xs-6 metod_paid plr-10 text-center" id="met1" name="met1">
          <a href="javascript:" onclick="selectmetodo(1);">            
              <img class="img-responsive ml-auto" src="<?= base_url()?>public/assets/images/creditos/paypal.png?v1" alt="">
          </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6 metod_paid plr-10" id="met2" name="met2">
          <a href="javascript:" onclick="selectmetodo(2);">
            <img class="img-responsive ml-auto" src="<?= base_url()?>public/assets/images/creditos/tdc.png?v1" alt="">
          </a>
        </div>
      </div>

      <div class="col-md-12 col-sm-12 col-xs-12 formcard ocul" id="formcard">
        <div class="col-md-offset-3 col-md-6 ">
           <hr>
           <div class="col-md-12">
              <div class="mb-10 text-left">
                <input type="text" class="form-control" placeholder="Número de Tarjeta" required="">
                <img class="imgmintdc" src="<?= base_url()?>public/assets/images/creditos/tdc.png?v1" alt="">
              </div>
              <div class="mb-20 text-left">
                <p class="bold1 mb-5" for="">Fecha de Vencimiento</p>
                <div class="col-md-3 col-sm-6 col-xs-6 pl-0 mb-10">
                 <select class="form-control">
                   <option value="">MM</option>
                   <option value="">06</option>
                 </select>
                </div>

                 <div class="col-md-4 col-sm-6 col-xs-6 pl-0 mb-20">
                   <select class="form-control">
                     <option value="">AA</option>
                     <option value="">1985</option>
                   </select>
                 </div>
              </div>

              <div class="mb-20">
                <input type="text" class="form-control" placeholder="Nombre del titular de la Tarjeta" required="">
              </div>

               <div class="mb-20">
               <div class="col-md-3 col-sm-3 col-xs-4 pl-0">
                 <input type="text" class="form-control" placeholder="CVV" required="">
                 
               </div>
               <div class="col-md-7 col-sm-7 col-xs-8 active-credit p-5 text-left">
                <img class="imgmincvv" src="<?= base_url()?>public/assets/images/creditos/cvv.png?v1" alt="">
                 <span class="font-10">3 digitos al reverso de la tarjeta</span>
               </div>
              </div>

           </div>
        </div>
      </div>
    </div>
  </div>

  <div class="text-right mt-20">
    <!-- <input type="hidden" required="" id="idmethod" name="idmethod"> -->     
    <button class="btn btn-sm btn-usar" type="button" id="nextBtn" onclick="nextPrev(-1)">Volver</button>
    <button class="btn btn-sm" type="button" id="nextBtn" onclick="nextPrev(1)">Confirmar Pago
    </button>
  </div>

  </div>

  <div class="tab-form-fich dest">
    <h3 class="bold1">Confirmar Compra</h3>
    <hr>

    <h5 class="bold1">Datos del Pedido</h5>
    <hr class="mb-0">

    <div class="col-md-12 text-center mb-20">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="col-md-8">
            <div class="row fila">
               <div class="col-md-9 col-sm-9 col-xs-9 text-left">
              <p class="p1">X-SMALL: 100 Fichas</p>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                <p class="p1">10€</p>
              </div>
            </div>

            <!-- fila en caso de cupon de descuento -->
            <div class="row fila">
               <div class="col-md-9 col-sm-9 col-xs-9 text-left">
              <p class="p1">5% de descuento por Cupón: <strong>05mxa2ck</strong></p>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                <p class="p1">-0,5€</p>
              </div>
            </div>
            
            <div class="row fila f2">
               <div class="col-md-9 col-sm-9 col-xs-9 text-left">
                <h5 class="bold1">Total a Pagar</h5>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-3 text-right">
                <h5 class="bold1">9,5€</h5>
              </div>
            </div>
          </div>

          <div class="col-md-4 mt-20 text-left">
            <h5 class="bold1">Método de Pago</h5>
              <p class="">Visa</p>
          </div>
        </div>
      </div>
    </div>



     <div class="text-right mt-20">
        <button class="btn btn-sm btn-usar" type="button" id="nextBtn" onclick="nextPrev(-1)">Volver</button>
        <button class="btn btn-sm" type="submit" id="">Aceptar</button>
      </div>
  </div>
</form>
</div>
</div>

</div>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab-form-fich");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    // document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    // document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab-form-fich");
  // Exit the function if any field in the current tab-form-fich is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab-form-fich:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab-form-fich");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  // for (i = 0; i < y.length; i++) {
  //   // If a field is empty...
  //   if (y[i].value == "") {
  //     // add an "invalid" class to the field:
  //     y[i].className += " invalid";
  //     // and set the current valid status to false
  //     valid = false;
  //   }
  // }
  // If the valid status is true, mark the step as finished and valid:
  // if (valid) {
    document.getElementsByClassName("m1")[currentTab].className += " finish";
    document.getElementsByClassName("m2")[currentTab].className += " finish";
  // }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("m1");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" m1.active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";

   var i, x = document.getElementsByClassName("m2");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" m2.active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

function selectpaquete(idpaquete){
 var idpaquete=idpaquete;
  var i, x = document.getElementsByClassName("card-credit");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active-credit", "");
  }
  document.getElementById("paq"+ idpaquete).className += " active-credit";

}

function selectmetodo(idmetodo){
 var idmetodo=idmetodo;
 console.log(idmetodo);

  var i, x = document.getElementsByClassName("metod_paid");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active-credit", "");
  }
  document.getElementById("met"+idmetodo).className += " active-credit";

  if (idmetodo=='2') {
    document.getElementById("formcard").className += " mostrar";
  }else{
    document.getElementById("formcard").className =document.getElementById("formcard").className.replace( /(?:^|\s)mostrar(?!\S)/g , '' )

  }
}

</script>