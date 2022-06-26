<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="public/style.css">

<div class="wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="p-4">
                    <form class="form">
                        <input name="s" placeholder="Please, type author here" >
                        <input class="btn btn-primary" id="searchSubmit" type="button" value="Search">
                    </form>
                    <div class="form-post-result"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelector('#searchSubmit').onclick = function() {
        this.classList.add("v2-but-disable");
        (async () => {
            const fields = document.querySelectorAll('.form input');
            const formData = new FormData();
            const data = [...fields].map( val => {
                formData.append([val.getAttribute('name')], val.value ? val.value : '');
            });
            const rawResponse = await fetch('index.php', {
                method: 'POST',
                credentials: 'include',
                body: formData
            });
            try{
                const content = await rawResponse.json();
                const res = content.map( (element,index) => {
                    return `<div class="result-item" style="animation-delay:${index/2}s">
                                <div class="row">
                                    <div class="col-md-6 pr-0"><div class="gr">${element.aname}</div></div>
                                    <div class="col-md-6 pl-0"><div class="gr">${element.bname}</div></div>
                                </div>
                            </div>`;
                });
                document.querySelector('.form-post-result').innerHTML = res.length ? res.join('') : 'Nothing found, sorry!';

            }catch(e){
                console.log(e);
            }
            this.classList.remove("v2-but-disable");
        })();
    }
</script>