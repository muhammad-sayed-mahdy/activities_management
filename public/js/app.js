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
                    for (let button of buttons) {
                        button.classList.remove('disabled');
                        button.disabled = false;
                    }
                } else {
                    for (let button of buttons) {
                        button.classList.add('disabled');
                        buttons.disabled = true;
                    }
                }

                // show the selected task and customer
                const task = document.getElementById('task_'+response['task_id']);
                if (task != null) {
                    task.selected = true;
                    toggleEndTaskButton(response['task_id']);
                }
                else {
                    document.getElementById('default_task').selected = true;
                }
                const customer = document.getElementById('customer_'+response['customer_id']);
                if (customer != null)
                    customer.selected = true;
                else
                    document.getElementById('default_customer').selected = true;

                // change the title, description and points to match the corresponding activity
                document.getElementById('title').value = response['title'];
                document.getElementById('description').textContent = response['description'];
                document.getElementById('points').textContent = response['points'];

                addAttachments(response['attachments'], true);
            }
        }
        const uploadInfo = document.getElementById('upload_info');
        uploadInfo.className = "hidden";
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

// add attachments names with remove buttons
function addAttachments(files, removeOld=false) {
    const attachmentsArea = document.getElementById('attachments_area');
    const fragment = document.createDocumentFragment();
    for (const file of files) {
        const div = document.createElement('div');

        // the file is sent from the backend
        if ('id' in file) {
            const link = document.createElement('a');
            link.href = "/attachments?id="+file['id'];
            link.textContent = file['name'];
            div.appendChild(link);
        } else {    // the file is still in the frontend and not yet uploaded
            const label = document.createElement('label');
            label.textContent = file['name'];
            div.appendChild(label);
        }

        const button = document.createElement('button');
        button.classList.add('remove_button');
        const iElement = document.createElement('i');
        iElement.className = "fa fa-fw fa-minus-circle remove_icon";
        button.appendChild(iElement);

        
        if ('id' in file) {
            button.value = file['id'];
        }
        button.addEventListener('click', removeAttachments);
        div.appendChild(button);
        
        fragment.appendChild(div);
    }
    if (removeOld) {
        attachmentsArea.innerHTML = "";
        const attachments = document.getElementById('attachments');
        attachments.value = ""; // remove all unuploaded files
    } else {
        // remove children that are not actually uploaded
        for (let child of attachmentsArea.children) {
            if (!child.lastChild.hasAttribute('value'))
                attachmentsArea.removeChild(child);
        }
    }
    attachmentsArea.appendChild(fragment);
}

document.getElementById('attachments').addEventListener('change', function(evt){
    const files = document.getElementById('attachments').files;
    addAttachments(files);
    const info = document.getElementById('upload_info');
    info.className = "is_danger";
});

function removeAttachments(evt) {
    let button = evt.target;
    if (button.nodeName == 'I')
        button = button.parentElement;
    // the button has already uploaded
    if (button.hasAttribute('value')) {
        axios.delete('/attachments', {params:{id:button.value}}).catch(function (error) {
            console.error(error);
        });
    } 
    button.parentElement.remove();
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
