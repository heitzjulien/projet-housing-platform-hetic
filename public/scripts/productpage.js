var imageno =1;
    displaying(imageno);

    function nextimg(n){
        displaying(imageno += n)
    }

    function currentSlide(n){
        displaying(imageno = n)
    }

    function displaying(n){
        var i;
        var image = document.getElementsByClassName("image");

        if(n > image.length){
            imageno = 1;
        }

        if(n < 1){
            imageno = image.length;
        }

        for(i=0; i < image.length; i++){
            image[i].style.display = "none";
        }

        image[imageno - 1].style.display = "block";
    }
