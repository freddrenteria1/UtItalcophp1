        var odsq = null
        var server = "https://utitalco.com/031/server/";
        var filesprox = []
        var filesinfo = []
        var usercal = sessionStorage.getItem('usercal');

        // if(usercal == null){
        //     location = 'login.html'
        // }

        cargarFilesDiarios()

        
        function inicio(){
            location = 'index.html'
        }

        function cargarFilesDiarios(){
            $.post(server+'verFilesDiarios.php',{},
            function(resp){
                filesdiarios = resp.filesdiarios
                filessem = resp.filessemana
                filesmes = resp.filesmes

                var html = ''

                if(resp.filesdiarios != null){
                    for(var i=0; i<filesdiarios.length; i++){
                        html += `
                            <div class="doc">
                                <a href="https://utitalco.com/031/server/archivos/${filesdiarios[i].archivo}" target="_blank">
                                <img src="../img/doc.jpg" width="70px" alt="">
                                    </a>
                                 <br>
                                <div class="nomb">
                                    ${filesdiarios[i].archivo}
                                </div>
                                
                            </div>
                        `
                    }
                    $('#archivosdiarios').html(html)
                }

                var html = ''

                if(filessem != null){
                    for(var i=0; i<filessem.length; i++){
                        html += `
                            <div class="doc">
                                <a href="https://utitalco.com/031/server/archivos/${filessem[i].archivo}" target="_blank">
                                <img src="../img/doc.jpg" width="70px" alt="">
                                </a>
                                <br>
                               <div class="nomb">
                                 
                                    ${filessem[i].archivo}    
                                 
                                </div>
                                 
                            </div>
                        `
                    }
                    $('#archivossem').html(html)
                }

                var html = ''

                if(filesmes != null){
                    for(var i=0; i<filesmes.length; i++){
                        html += `
                            <div class="doc">
                                <a href="https://utitalco.com/031/server/archivos/${filesmes[i].archivo}" target="_blank">
                                <img src="../img/doc.jpg" width="70px" alt="">
                                </a>
                                <br>
                               <div class="nomb">
                                 
                                    ${filesmes[i].archivo}    
                                 
                                </div>
                                 
                            </div>
                        `
                    }
                    $('#archivosmes').html(html)
                }


            })
        }
