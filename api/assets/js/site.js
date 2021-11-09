let rendererImages;

function createPriseHtml() {
    rendererImages = [];
    let html = '<span class="first-prise">' + $('#firstPrise').val() + '</span><span class="last-prise">' + $('#lastPrise').val() + '</span>';
    html = $.parseHTML(html);
    let priseHtmlId = $('#priseHtmlId');
    priseHtmlId.html(null);
    priseHtmlId.append(html);
    createPriseImg();
}

function createPriseImg() {
    html2canvas(document.getElementById("priseHtmlId"), {backgroundColor: 'transparent'}).then(function (canvas) {
        let image = new Image();
        image.src = canvas.toDataURL("image/png");
        let stockImages = document.getElementById('imageInput').files;
        let formData = new FormData();
        for (let i = 0; i < stockImages.length; i++) {
            formData.append('stockImages[]', stockImages[i]);
        }
        formData.append('priseImg', image.src);
        $.ajax({
            xhr: function () {
                let xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        let percentComplete = evt.loaded / evt.total;
                        let progress_bar = $('.progress-bar');
                        $("#firstPrise").prop('disabled', true);
                        $("#lastPrise").prop('disabled', true);
                        $("#imageInput").prop('disabled', true);
                        $("#progressButton").prop('disabled', true);
                        progress_bar.html(null);
                        progress_bar.append('<small>' + Math.round(percentComplete * 100) + ' %</small>');
                        progress_bar.attr('aria-valuenow', percentComplete * 100);
                        progress_bar.css({width: percentComplete * 100 + '%'});
                        if (percentComplete === 1) {
                            setTimeout(()=> {
                                for (let i = 1000; i > 0; i--) {
                                    progress_bar.css({width: i / 10 + '%'});
                                    progress_bar.html(null);
                                    progress_bar.append('<small>' + Math.round(i / 10) + ' %</small>');
                                }
                            }, 300);
                            // $('.progress').addClass('hide');
                        }
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: "make-invoice.php",
            processData: false,
            contentType: false,
            data: formData,
            success: function (result) {
                $("#firstPrise").prop('disabled', false);
                $("#lastPrise").prop('disabled', false);
                $("#imageInput").prop('disabled', false);
                $("#progressButton").prop('disabled', false);
                let downloadLinkDiv = $("#downloadLink");
                downloadLinkDiv.html(null);
                let downLoadLink = '<a class="btn btn-outline-secondary btn-sm" href="' + result['zipFolderPath'] + '">Yüklə</a>';
                downloadLinkDiv.append(downLoadLink);
            }
        });
    });
}