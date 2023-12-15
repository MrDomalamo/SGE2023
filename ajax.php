
<!--AJAX PARA CHAMAR O ENVIAR.PHP DO EMAIL -->
<script type="text/javascript">
    $(document).ready(function(){
        
        $('#btn-enviar').click(function(event){
            event.preventDefault();
            
            $.ajax({
                url: "enviar.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem){

                    $('#msg').removeClass()

                    if(mensagem.trim() === 'Verifique o seu email!'){
                        
                        $('#msg').addClass('text-success')

                       
                        $('#nome').val('');
                        $('#email').val('');
                        $('#senha').val('');
                      
                       
                        //$('#btn-fechar').click();
                        //location.reload();


                    }else{
                        
                        $('#msg').addClass('text-danger')
                    }
                    
                    $('#msg').text(mensagem)

                },
                
            })
        })
    })
</script>

$query = $pdo->query("SELECT * from emails where email = '$email'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res) == 0){
		$query = $pdo->prepare("INSERT INTO emails SET email = :email, nome = :nome, enviar = 'sim'");

		$query->bindValue(":email", "$email");
		$query->bindValue(":nome", "$nome");		
		$query->execute();
	}	
