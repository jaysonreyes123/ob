<style>
    #loader{
            display: none;
            margin: 0px;
            padding: 0px;
            position: absolute;
            right: 0px;
            top: 0px;
            width: 100%;
            height: 100vh;
            background-color: rgba(255, 255, 255,0.5);
            z-index: 9999;
        }
        #loading{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%)
        } 
        #loading .spinner-grow{
            width: 0.4rem !important;
            height: 0.4rem !important;
        }
</style>
<div id="loader">
    <div id="loading">
        <h1>Processing
            <div class="spinner-grow" role="status"></div>
            <div class="spinner-grow" role="status"></div>
            <div class="spinner-grow" role="status"></div>
        </h1>
    </div>   
</div>
<script>
    function loader(show = true){
        if(show){
            $("#loader").show();
        }
        else{
            $("#loader").hide();
        }
    }
</script>