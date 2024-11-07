<style>
    .service-modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
    }

    .service-modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        width: 400px;
        text-align: center;
    }

    .service-modal-close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .service-modal-close:hover,
    .service-modal-close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<div id="service-modal" class="service-modal">
    <div class="service-modal-content">
        <span class="service-modal-close">&times;</span>
        <!-- <h2 id="modalTitle">Service Title</h2> -->

        <div id="dynamicForm">

        </div>

    </div>
</div>