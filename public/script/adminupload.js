
    var images = [];
    function selectImage() {
        var image = document.getElementById('otherImage').files;
        for (let i = 0; i < image.length; i++) {
            if (check_duplicate(image[i].name)) {
                images.push({
                    'name': image[i].name,
                    'url': URL.createObjectURL(image[i]),
                    'file': image[i]
                });
            } else {
                alert(image[i].name + ' is already exists');
            }
        }
        // document.getElementById('otherImage').value = '';
        document.getElementById('imgPre').innerHTML = showImage();
    }

    function showImage() {
        var image = "";
        images.forEach((getImg) => {
            image += `<div class="col">
                    <img src="${getImg.url}" alt="">
                    <span class="closePre" onclick="deleteImg(${images.indexOf(getImg)})">&times;</span>
                </div>`
        });

        return image;
    }


    function deleteImg(toDel) {

        images.splice(toDel, 1);
        var image = document.getElementById('otherImage').files;

        let toRemove = Array.from(image);
        toRemove.splice(toDel, 1);

        console.log(toRemove);
        document.getElementById('imgPre').innerHTML = showImage();
    }

    function check_duplicate(name) {
        var image = true;
        if (images.length > 0) {
            for (e = 0; e < images.length; e++) {
                if (images[e].name == name) {
                    image = false;
                    break;
                }
            }
        }

        return image;
    }

