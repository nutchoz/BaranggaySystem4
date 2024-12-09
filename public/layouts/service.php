<div class="container-service container py-5">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        <!-- Service Item 1 -->
        <div class="col">
            <div class="card h-100 text-center">
                <img src="../assets/baranggayClearance.png" class="card-img-top service-image"
                    alt="Baranggay Clearance">
                <div class="card-body service-items">
                    <h5 class="card-title">Baranggay Clearance</h5>
                    <input type="hidden" value="baranggayClearance">
                    <p class="card-text">This service provides official clearance from the barangay.</p>
                    <div class="d-flex justify-content-center gap-2 buttons-service">
                        <button class="btn btn-success take-service">Take this service!</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service Item 2 -->
        <div class="col">
            <div class="card h-100 text-center">
                <img src="../assets/baranggayClearance.png" class="card-img-top service-image"
                    alt="Baranggay Clearance">
                <div class="card-body service-items">
                    <h5 class="card-title">Baranggay Clearance</h5>
                    <input type="hidden" value="baranggayClearance">
                    <p class="card-text">This service provides official clearance from the barangay.</p>
                    <div class="d-flex justify-content-center gap-2 buttons-service">
                        <button class="btn btn-success take-service">Take this service!</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service Item 3 -->
        <div class="col">
            <div class="card h-100 text-center">
                <img src="../assets/baranggayClearance.png" class="card-img-top service-image"
                    alt="Baranggay Clearance">
                <div class="card-body service-items">
                    <h5 class="card-title">Baranggay Clearance</h5>
                    <input type="hidden" value="baranggayClearance">
                    <p class="card-text">This service provides official clearance from the barangay.</p>
                    <div class="d-flex justify-content-center gap-2 buttons-service">
                        <button class="btn btn-success take-service">Take this service!</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service Item 4 -->
        <div class="col">
            <div class="card h-100 text-center">
                <img src="../assets/baranggayClearance.png" class="card-img-top service-image"
                    alt="Baranggay Clearance">
                <div class="card-body service-items">
                    <h5 class="card-title">Baranggay Clearance</h5>
                    <input type="hidden" value="baranggayClearance">
                    <p class="card-text">This service provides official clearance from the barangay.</p>
                    <div class="d-flex justify-content-center gap-2 buttons-service">
                        <button class="btn btn-success take-service">Take this service!</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service Item 5 -->
        <div class="col">
            <div class="card h-100 text-center">
                <img src="../assets/baranggayClearance.png" class="card-img-top service-image"
                    alt="Baranggay Clearance">
                <div class="card-body service-items">
                    <h5 class="card-title">Baranggay Clearance</h5>
                    <input type="hidden" value="baranggayClearance">
                    <p class="card-text">This service provides official clearance from the barangay.</p>
                    <div class="d-flex justify-content-center gap-2 buttons-service">
                        <button class="btn btn-success take-service">Take this service!</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service Item 6 -->
        <div class="col">
            <div class="card h-100 text-center">
                <img src="../assets/baranggayClearance.png" class="card-img-top service-image"
                    alt="Baranggay Clearance">
                <div class="card-body service-items">
                    <h5 class="card-title">Baranggay Clearance</h5>
                    <input type="hidden" value="baranggayClearance">
                    <p class="card-text">This service provides official clearance from the barangay.</p>
                    <div class="d-flex justify-content-center gap-2 buttons-service">
                        <button class="btn btn-success take-service">Take this service!</button>
                    </div>
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

    function closeForm() {
        modal.style.display = 'none';
    }
    closeBtn.onclick = function () {
        modal.style.display = 'none';
    };
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };

</script>