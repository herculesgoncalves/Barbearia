<?php require_once("sistema/conexao.php") ?>
<!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <div class="footer_content ">
        <div class="row ">
          <div class="col-md-5 col-lg-5 footer-col">
            <div class="footer_detail">
              <a href="index.html">
                <h4>
                  <?php echo $nome_sistema ?>
                </h4>
              </a>
              <p>
                <?php echo $texto_rodape ?>
              </p>
            </div>
          </div>
          <div class="col-md-7 col-lg-4 ">
            <h4>
              Contatos
            </h4>
            <div class="contact_nav footer-col">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  <?php echo $endereco_sistema ?>
                </span>
              </a>
              <a href="http://api.whatsapp.com/send?1=pt_BR&phone=<?php echo $tel_whatsapp ?>">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Whatsapp : <?php echo $whatsapp_sistema ?>
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  Email : <?php echo $email_sistema ?>
                </span>
              </a>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="footer_form footer-col">
              <h4>
                CADASTRE-SE
              </h4>
              <form id="form_cadastro">
                <input type="text" name="telefone" id="telefone_rodape" placeholder="Seu Telefone DDD + número" />
                <input type="text" name="nome" placeholder="Seu Nome" />
                <input type="text" name="nome" placeholder="Seu Dia" />
                <button type="submit">
                  Cadastrar
                </button>
              </form>
              <br><small><div id="mensagem-rodape"></div></small>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </footer>
  <!-- footer section -->

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap"></script>
  <!-- End Google Map -->

    <!-- Mascaras JS -->
<script type="text/javascript" src="sistema/painel/js/mascaras.js"></script>

<!-- Ajax para funcionar Mascaras JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 


</body>

</html>


<script type="text/javascript">
  
$("#form_cadastro").submit(function () {

    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'ajax/cadastrar.php',
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem-rodape').text('');
            $('#mensagem-rodape').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {
               //$('#mensagem-rodape').addClass('text-success')
                $('#mensagem-rodape').text(mensagem)

            } else {

                //$('#mensagem-rodape').addClass('text-danger')
                $('#mensagem-rodape').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});


</script>