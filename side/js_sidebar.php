<script>
//use different .pic0 class when accessing outside
            const menuu = document.querySelector('.pic0');
            const sidebar = document.querySelector('.sidebar');
            const poppp = document.querySelector('.poppp');

            let maincc = document.querySelector('.main_content1');


            
            function load(){
                try {
    
                    if(sidebar.style.display === 'block'){
                    maincc.style.width = '75%';
                    maincc.style.marginLeft = '23%';
                    maincc.style.color = 'red';
                    } else {
                    maincc.style.width = '90%';
                    maincc.style.marginLeft = '8%';
                    maincc.style.color = 'blue';
                    }
                
                } catch {
                    console.log('suuuuuuu');
                }
                
            }
            

            //event listeners
            menuu.addEventListener('click', ()=> {
                event.stopPropagation();
                sidebar.style.display = 'block';
                load();
            })
            window.addEventListener('click', ()=> {
                if(!sidebar.contains(event.target)){
                sidebar.style.display = 'none';
                load();
                }
                console.log(event.target);

                try {
                    if(event.target.children[0].classList.contains('popi')){
                
                    console.log('succc');
                    if(poppp.style.display === "block"){
                        poppp.style.display = "none";
                    } else {
                        poppp.style.display = "block";
                    }
            }
                } catch {
                    console.log('suuuccc');
                }
                    
            })

            



</script>