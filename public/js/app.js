// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}

// change the page content according to the chosen activity
document.getElementById("change_activity").addEventListener('click', function (evt) {
    if (evt.target.nodeName == "OPTION") {
        const activityId = evt.target.value;
        const Http = new XMLHttpRequest();
        const url = '/?activityId='+activityId;
        Http.open("GET", url);
        Http.send();

        Http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const response = JSON.parse(Http.responseText);
                
                // toogle the buttons disability
                const buttons = [
                    document.getElementById('saveButton'),
                    document.getElementById('startButton'),
                    document.getElementById('endActivityButton')
                ];
                if (response['ended_at'] == null) {
                    for (const button of buttons) {
                        button.classList.remove('disabled');
                        button.disabled = false;
                    }
                } else {
                    for (const button of buttons) {
                        button.classList.add('disabled');
                        buttons.disabled = true;
                    }
                }

                // show the selected task and customer
                const $task = document.getElementById('task_'+response['task_id']);
                if ($task != null) {
                    $task.selected = true;
                    toggleEndTaskButton(response['task_id']);
                }
                else {
                    document.getElementById('default_task').selected = true;
                }
                const $customer = document.getElementById('customer_'+response['customer_id']);
                if ($customer != null)
                    $customer.selected = true;
                else
                    document.getElementById('default_customer').selected = true;

                // change the title, description and points to match the corresponding activity
                document.getElementById('title').value = response['title'];
                document.getElementById('description').textContent = response['description'];
                document.getElementById('points').textContent = response['points'];
            }
        }
        showAndHide();
    }
});

document.getElementById('task_id').addEventListener('input', function (evt) {
    const taskId = evt.target.value;
    toggleEndTaskButton(taskId);
});

// change End Task button disability
function toggleEndTaskButton(taskId) {
    const Http = new XMLHttpRequest();
    const url = '/?taskId='+taskId;
    Http.open("GET", url);
    Http.send();

    Http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const response = JSON.parse(Http.responseText);
            const button = document.getElementById('endTaskButton');
            if (!response['ended']) {
                button.classList.remove('disabled');
                button.disabled = false;
            } else {
                button.classList.add('disabled');
                button.disabled = true;
            }
        }
    }
}

// Modal Image Gallery
function onClick(element) {
    document.getElementById("img01").src = element.src;
    document.getElementById("modal01").style.display = "block";
    var captionText = document.getElementById("caption");
    captionText.innerHTML = element.alt;
}

function showAndHide() {
    var x = document.getElementById("show_hide");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
