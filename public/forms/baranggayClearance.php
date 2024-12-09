<form id="service-form" method="POST" action="redirect.php" enctype="multipart/form-data">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6" style="min-width: 500px">
                <div class="card shadow-lg position-relative">
                    <!-- Close Button -->
                    <div class="card-body">
                        <h2 class="text-center mb-4 service-form-title text-success">BARANGGAY CLEARANCE APPLICATION
                        </h2>

                        <!-- Hidden Input Fields -->
                        <input type="hidden" name="type" value="baranggay-clearance">
                        <input type="hidden" name="price" value="100">
                        <input type="hidden" name="serviceType" value="1">

                        <!-- Full Name -->
                        <div class="form-group mb-3">
                            <label for="fullName" class="form-label">Full Name:</label>
                            <input type="text" class="form-control" id="fullName" name="fullName"
                                placeholder="Enter your full name" required>
                        </div>

                        <!-- Address -->
                        <div class="form-group mb-3">
                            <label for="address" class="form-label">Address:</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Enter your address" required>
                        </div>

                        <!-- Contact Number -->
                        <div class="form-group mb-3">
                            <label for="contactNumber" class="form-label">Contact Number:</label>
                            <input type="tel" class="form-control" id="contactNumber" name="contactNumber"
                                placeholder="Enter your contact number" required>
                        </div>

                        <!-- Purpose of Clearance -->
                        <div class="form-group mb-3">
                            <label for="purpose" class="form-label">Purpose of Clearance:</label>
                            <textarea class="form-control" id="purpose" name="purpose"
                                placeholder="Enter the purpose of clearance" rows="4" required></textarea>
                        </div>

                        <!-- ID Proof Upload -->
                        <div class="form-group mb-3">
                            <label for="idProof" class="form-label">Upload ID Proof:</label>
                            <input type="file" class="form-control" id="idProof" name="idProof" accept="image/*"
                                required>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-success btn-lg mt-4 px-4">Submit Application</button>
                            <button type="button" class="btn btn-danger btn-lg mt-4 px-4 me-3" aria-label="Close"
                                onclick="closeForm()">Close</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>

</script>