<style>
    
</style>

<form id="service-form" method="POST" action="submitClearance.php">
    <h2 class="service-form-title">BARANGGAY CLEARANCE APPLICATION</h2>

    <div class="form-group">
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" required>
    </div>

    <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" placeholder="Enter your address" required>
    </div>

    <div class="form-group">
        <label for="contactNumber">Contact Number:</label>
        <input type="tel" id="contactNumber" name="contactNumber" placeholder="Enter your contact number" required>
    </div>

    <div class="form-group">
        <label for="purpose">Purpose of Clearance:</label>
        <textarea id="purpose" name="purpose" placeholder="Enter the purpose of clearance" required></textarea>
    </div>

    <div class="form-group">
        <label for="idProof">Upload ID Proof:</label>
        <input type="file" id="idProof" name="idProof" accept="image/*" required>
    </div>

    <div class="form-group">
        <button type="submit" class="btn-submit">Submit Application</button>
    </div>
</form>