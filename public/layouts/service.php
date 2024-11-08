<div class="container-service">
    <div class="service-rows">
        <div class="service-cols">
            <div class="service-items">
                <img src="../assets/baranggayClearance.png" class="service-image" />
                <input type="hidden" value="baranggayClearance">
                <div class="service-title">Baranggay Clearance</div>
                <div class="buttons-service"
                    style="display: flex; width: 90%; height: 100%; gap: 10px; margin-left: 5%;">
                    <button class="take-service">Take this service!</button>
                    <button class="take-service disabled">Track</button>
                </div>
            </div>
            <div class="service-items">
                <img src="../assets/baranggayClearance.png" class="service-image" />
                <input type="hidden" value="baranggayClearance">
                <div class="service-title">Baranggay Clearance</div>
                <div class="buttons-service"
                    style="display: flex; width: 90%; height: 100%; gap: 10px; margin-left: 5%;">
                    <button class="take-service">Take this service!</button>
                    <button class="take-service disabled">Track</button>
                </div>
            </div>
            <div class="service-items">
                <img src="../assets/baranggayClearance.png" class="service-image" />
                <input type="hidden" value="baranggayClearance">
                <div class="service-title">Baranggay Clearance</div>
                <div class="buttons-service"
                    style="display: flex; width: 90%; height: 100%; gap: 10px; margin-left: 5%;">
                    <button class="take-service">Take this service!</button>
                    <button class="take-service disabled">Track</button>
                </div>
            </div>
        </div>
        <div class="service-cols">
            <div class="service-items">
                <img src="../assets/baranggayClearance.png" class="service-image" />
                <input type="hidden" value="baranggayClearance">
                <div class="service-title">Baranggay Clearance</div>
                <div class="buttons-service"
                    style="display: flex; width: 90%; height: 100%; gap: 10px; margin-left: 5%;">
                    <button class="take-service">Take this service!</button>
                    <button class="take-service disabled">Track</button>
                </div>
            </div>
            <div class="service-items">
                <img src="../assets/baranggayClearance.png" class="service-image" />
                <input type="hidden" value="baranggayClearance">
                <div class="service-title">Baranggay Clearance</div>
                <div class="buttons-service"
                    style="display: flex; width: 90%; height: 100%; gap: 10px; margin-left: 5%;">
                    <button class="take-service">Take this service!</button>
                    <button class="take-service disabled">Track</button>
                </div>
            </div>
        </div>
    </div>

</div>


<script>

    function getForm(link, element) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'forms/' + link + '.php', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                element.innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }

    var modal = document.getElementById('service-modal');
    var closeBtn = document.getElementsByClassName('service-modal-close')[0];

    document.querySelectorAll('.buttons-service').forEach(function (button) {
        button.addEventListener('click', function () {

            var serviceTitle = this.previousElementSibling;
            var serviceTarget = serviceTitle.previousElementSibling.value;

            var form = document.getElementById('dynamicForm');
            getForm(serviceTarget, form);

            modal.style.display = 'flex';
        });
    });

    closeBtn.onclick = function () {
        modal.style.display = 'none';
    };
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };

</script>