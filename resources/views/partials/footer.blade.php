<footer>
    <div class="container py-4">
       <div class="row g-0 row-cols-1 row-cols-md-2 row-cols-lg-3 w-100 justify-content-between">
        
        <div class="col gap-2 d-flex flex-column justify-content-center align-items-center">
            <p class="fw-bold"><a href="http://localhost:5173/">Fooder</a></p>
            <p class="fw-bold"><a href="http://localhost:5173/about-us">Chi siamo</a></p>
            <p class="fw-bold"><a href="#">Contattaci</a></p>
        </div>

        <div class="col gap-2 d-flex flex-column justify-content-center align-items-center">
            <p class="fw-bold"><a href="{{route('faq')}}">FAQ</a></p>
            <p class="fw-bold"><a href="#">Termini e condizioni</a></p>
            <p class="fw-bold"><a href="#">Privacy</a></p>
            
           

        </div>
       </div>
    </div>
</footer>

<style lang="scss" scoped>  
    footer{
    
        background-color:#18475D;
        color:#FDB721;
        p{
            font-size:20px;
        }
    
    }
</style>