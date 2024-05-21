<?php
include('header.php');
?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <span id="sucessmsg" class="text-success"></span>
                    <h4 class="card-title">Edit test</h4>
                    <button type="button" class="btn btn-primary float-right mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add questions
                    </button>
                    <!-- <p class="card-description">
                    Basic form layout
                  </p> -->
                    <form class="forms-sample" id="testform">
                        <div id="containerform">

                        </div>


                        <button class="btn btn-primary mr-2">Save</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        <style>
            .nicemodal {
                max-width: 700px;
            }
        </style>
        <div class="col-md-6">

            <div id="questionstable" class="card">
                <table class="table">
                    <thead>
                        <th>Sr No.</th>
                        <th>Question</th>
                        <th>Edit</th>
                    </thead>
                    <tbody id="questionmaintable">

                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog nicemodal">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h6 class="modal-title fs-5" id="exampleModalLabel">Add questions</h6>
                            <span class="text-success" id="sucessmsgquest"></span>

                        </div>
                        <form id="savequestion">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="exampleInputUsername1">Title</label>
                                    <input type="text" class="form-control" name="question" id="question" placeholder="Question Title">
                                    <span class="error-question text-danger"></span>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Option 1</label>
                                            <textarea type="text" class="form-control" name="op1" id="op1" placeholder="Options"></textarea>
                                            <span class="error-op1 text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Option 2</label>
                                            <textarea type="text" class="form-control" name="op2" id="op2" placeholder="Options"></textarea>
                                            <span class="error-op2 text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Option 3</label>
                                            <textarea type="text" class="form-control" name="op3" id="op3" placeholder="Options"></textarea>
                                            <span class="error-op3 text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Option 4</label>
                                            <textarea type="text" class="form-control" name="op4" id="op4" placeholder="Options"></textarea>
                                            <span class="error-op4 text-danger"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelectGender">Correct Answer</label>
                                    <select class="form-control" name="rightanswer" id="rightanswer">
                                        <option value=""></option>
                                        <option value="op1">option 1</option>
                                        <option value="op2">option 2</option>
                                        <option value="op3">option 3</option>
                                        <option value="op4">option 4</option>
                                    </select>
                                    <span class="error-answer text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectGender">Marks</label>
                                    <select class="form-control" name="marks" id="marks">
                                        <option value=""></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">3</option>
                                    </select>
                                    <span class="error-marks text-danger"></span>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="questionsave">Save Question</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Edit question Modal -->


<div class="modal fade" id="questiommodal" tabindex="-1" aria-labelledby="editquestmodal" aria-hidden="true">
    <div class="modal-dialog nicemodal">
        <div class="modal-content">
            <div class="modal-header">

                <h6 class="modal-title fs-5" id="editquestmodal">Edit questions</h6>
                <span class="text-success" id="sucessmsgquestedit"></span>

            </div>
            <form id="updatequestion">
                <div class="modal-body" id="editform">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="questionsave">Save Question</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>
<script>
    const queryString = window.location.search;
    // console.log(queryString);
    const urlParams = new URLSearchParams(queryString);
    const id = urlParams.get('id');
    // console.log(urlParams.get('id'))
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "codes/functions.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // console.log(xhr.response);
                var resp = JSON.parse(xhr.response);

                var html = "<div class='form-group'>" +
                    "<label>Title of test</label>" +
                    "<input type='text' name='title' value='" + resp.name + "' class='form-control' placeholder='Title'>" +
                    "<span class='text-danger title-error'></span>" +
                    "</div>" +
                    "<div class='form-group'>" +
                    "<label>Duration in hours</label>" +
                    "<input type='text' name='duration' value='" + resp.duration + "' class='form-control' placeholder='Duration'>" +
                    "<span class='text-danger duration-error'></span>" +
                    "</div>";

                document.querySelector("#containerform").innerHTML = html;

            } else {
                console.log("Error: " + xhr.status);
            }
        }
    }
    xhr.send("id=" + encodeURIComponent(id));

    document.querySelector("#testform").addEventListener("submit", function(e) {
        e.preventDefault();
        var title = document.getElementsByName("title")[0].value;
        var duration = document.getElementsByName("duration")[0].value;
        var valid = false;
        if (title.length === 0) {

            document.querySelector(".title-error").innerHTML = "Please fill the title";
        } else {
            valid = true;
            document.querySelector(".title-error").innerHTML = "";
        }
        // console.log(duration.length + "duratu")
        if (duration.length === 0) {
            document.querySelector(".duration-error").innerHTML = "Please fill the duration";
        } else {
            valid = true;
            document.querySelector(".duration-error").innerHTML = "";
        }

        if (valid) {
            var form = document.querySelector("#testform");
            var formData = new FormData(form);
            formData.append('id', id);
            // console.log("Hi submit")
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "codes/update-test.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // console.log(xhr.response);
                        var resp = JSON.parse(xhr.response);
                        //  console.log(resp.status);
                        if (resp.success === 'Updated successfully') {
                            document.querySelector("#sucessmsg").innerHTML = resp.success;
                        }

                        if (resp.error) {
                            document.querySelector("#sucessmsg").innerHTML = resp.error;
                        }

                    } else {
                        console.log("Error")
                    }
                }
            }
            xhr.send(formData);
        }

    })

    document.querySelector("#savequestion").addEventListener("submit", function(e) {
        e.preventDefault();
        var question = document.getElementById("question").value;
        var op1 = document.getElementById("op1").value;
        var op2 = document.getElementById("op2").value;
        var op3 = document.getElementById("op3").value;
        var op4 = document.getElementById("op4").value;
        var rightanswer = document.getElementById("rightanswer").value;
        var marks = document.getElementById("marks").value;

        var valid = false;
        if (question.length === 0) {

            document.querySelector(".error-question").innerHTML = "Please fill the title";
        } else {
            valid = true;
            document.querySelector(".error-question").innerHTML = "";
        }

        // Validate option 1
        if (op1.length === 0) {
            valid = false;
            document.querySelector(".error-op1").innerHTML = "Please fill option 1";
        } else {
            document.querySelector(".error-op1").innerHTML = "";
        }

        // Validate option 2
        if (op2.length === 0) {
            valid = false;
            document.querySelector(".error-op2").innerHTML = "Please fill option 2";
        } else {
            document.querySelector(".error-op2").innerHTML = "";
        }

        // Validate option 3
        if (op3.length === 0) {
            valid = false;
            document.querySelector(".error-op3").innerHTML = "Please fill option 3";
        } else {
            document.querySelector(".error-op3").innerHTML = "";
        }

        // Validate option 4
        if (op4.length === 0) {
            valid = false;
            document.querySelector(".error-op4").innerHTML = "Please fill option 4";
        } else {
            document.querySelector(".error-op4").innerHTML = "";
        }

        // Validate correct answer
        if (rightanswer.length === 0) {
            valid = false;
            document.querySelector(".error-answer").innerHTML = "Please select the correct answer";
        } else {
            document.querySelector(".error-answer").innerHTML = "";
        }

        // Validate correct answer
        if (marks.length === 0) {
            valid = false;
            document.querySelector(".error-marks").innerHTML = "Please enter marks";
        } else {
            document.querySelector(".error-marks").innerHTML = "";
        }

        if (valid) {
            var form = document.querySelector("#savequestion");
            var formData = new FormData(form);
            formData.append('id', id);
            // console.log("Hi submit")
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "codes/add-question.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // console.log(xhr.response);
                        var resp = JSON.parse(xhr.response);
                        //  console.log(resp.status);
                        if (resp.success === 'Added successfully') {
                            document.querySelector("#sucessmsgquest").innerHTML = resp.success;
                            document.getElementById("savequestion").reset();
                            allquestiosns();
                        }

                        if (resp.error) {
                            document.querySelector("#sucessmsgquest").innerHTML = resp.error;
                        }

                    } else {
                        console.log("Error")
                    }
                }
            }
            xhr.send(formData);
        } else {
            console.log("Form is invalid!");
        }
    })
    allquestiosns();

    function allquestiosns() {
        const queryString = window.location.search;
        // console.log(queryString);
        const urlParams = new URLSearchParams(queryString);
        const id = urlParams.get('id');
        // console.log(urlParams.get('id'))
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "codes/showquestions.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // console.log(xhr.response);
                    var resp = JSON.parse(xhr.response);
                    console.log(resp)
                    var html = '';
                    var i = 1;
                    resp.forEach(question => {
                        html += "<tr>" +
                            "<td>" + i + "</td>" +
                            "<td>" + question.question + "</td>" +
                            "<td>" + "<a class='editqust' data-bs-toggle='modal' data-bs-target='#questiommodal' data-questid='" + question.id + "' href='javascript:void(0)'>edit</a>" + "</td>" +
                            "</tr>";
                        i++;
                    })

                    document.querySelector("#questionmaintable").innerHTML = html;
                    var allquestions = document.querySelectorAll(".editqust");
                    console.log(allquestions)
                    allquestions.forEach(element => {
                        element.addEventListener("click", function(e) {
                            e.preventDefault()
                            var id = this.getAttribute("data-questid");
                            // console.log(id)

                            var questindex = resp.findIndex(question => question.id === parseInt(id));
                            // console.log(questindex)
                            // console.log(resp[questindex].question);

                            var questionData = resp[questindex];

                            if (questindex !== -1) {
                                var html = `
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Title</label>
                                        <input type="text" value="${questionData.question}" class="form-control" name="question" id="questionedit" placeholder="Question Title">
                                        <span class="erroredit-question text-danger"></span>
                                        <input name="questionid" type="hidden" id="questionid" value="${questionData.id}">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Option 1</label>
                                                <textarea class="form-control" name="op1" id="editop1" placeholder="Options">${questionData.op1}</textarea>
                                                <span class="erroredit-op1 text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Option 2</label>
                                                <textarea class="form-control" name="op2" id="editop2" placeholder="Options">${questionData.op2}</textarea>
                                                <span class="erroredit-op2 text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Option 3</label>
                                                <textarea class="form-control" name="op3" id="editop3" placeholder="Options">${questionData.op3}</textarea>
                                                <span class="erroredit-op3 text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Option 4</label>
                                                <textarea class="form-control" name="op4" id="editop4" placeholder="Options">${questionData.op4}</textarea>
                                                <span class="erroredit-op4 text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Correct Answer</label>
                                        <select class="form-control" name="rightanswer" id="editrightanswer">
                                            <option value=""></option>
                                            <option value="op1" ${questionData.rightanswer === 'op1' ? 'selected' : ''}>option 1</option>
                                            <option value="op2" ${questionData.rightanswer === 'op2' ? 'selected' : ''}>option 2</option>
                                            <option value="op3" ${questionData.rightanswer === 'op3' ? 'selected' : ''}>option 3</option>
                                            <option value="op4" ${questionData.rightanswer === 'op4' ? 'selected' : ''}>option 4</option>
                                        </select>
                                        <span class="erroredit-answer text-danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelectGender">Marks</label>
                                        <select class="form-control" name="marks" id="editmarks">
                                            <option value=""></option>
                                            <option value="1" ${questionData.marks == 1 ? 'selected' : ''}>1</option>
                                            <option value="2" ${questionData.marks == 2 ? 'selected' : ''}>2</option>
                                            <option value="3" ${questionData.marks == 3 ? 'selected' : ''}>3</option>
                                            <option value="4" ${questionData.marks == 4 ? 'selected' : ''}>4</option>
                                        </select>
                                        <span class="erroredit-marks text-danger"></span>
                                    </div>
                                `;

                                // Assuming you have a container element with id 'form-container'
                                document.getElementById('editform').innerHTML = html;

                                document.querySelector("#updatequestion").addEventListener("submit", function(e) {
                                    e.preventDefault();
                                    var question = document.getElementById("questionedit").value;
                                    var op1 = document.getElementById("editop1").value;
                                    var op2 = document.getElementById("editop2").value;
                                    var op3 = document.getElementById("editop3").value;
                                    var op4 = document.getElementById("editop4").value;
                                    var rightanswer = document.getElementById("editrightanswer").value;
                                    var marks = document.getElementById("editmarks").value;
                                    var id = document.getElementById("questionid").value;
                                    // console.log(question)

                                    // var formdata = {
                                    //     "question": question,
                                    //     "op1": op1,
                                    //     "op2": op2,
                                    //     "op3": op3,
                                    //     "op4": op4,
                                    //     "rightanswer": rightanswer,
                                    //     "marks": marks,
                                    //     "id": id

                                    // }

                                    var valid = false;
                                    if (question.length === 0) {

                                        document.querySelector(".erroredit-question").innerHTML = "Please fill the title";
                                    } else {
                                        valid = true;
                                        document.querySelector(".erroredit-question").innerHTML = "";
                                    }

                                    // Validate option 1
                                    if (op1.length === 0) {
                                        valid = false;
                                        document.querySelector(".erroredit-op1").innerHTML = "Please fill option 1";
                                    } else {
                                        document.querySelector(".erroredit-op1").innerHTML = "";
                                    }

                                    // Validate option 2
                                    if (op2.length === 0) {
                                        valid = false;
                                        document.querySelector(".erroredit-op2").innerHTML = "Please fill option 2";
                                    } else {
                                        document.querySelector(".erroredit-op2").innerHTML = "";
                                    }

                                    // Validate option 3
                                    if (op3.length === 0) {
                                        valid = false;
                                        document.querySelector(".erroredit-op3").innerHTML = "Please fill option 3";
                                    } else {
                                        document.querySelector(".erroredit-op3").innerHTML = "";
                                    }

                                    // Validate option 4
                                    if (op4.length === 0) {
                                        valid = false;
                                        document.querySelector(".erroredit-op4").innerHTML = "Please fill option 4";
                                    } else {
                                        document.querySelector(".erroredit-op4").innerHTML = "";
                                    }

                                    // Validate correct answer
                                    if (rightanswer.length === 0) {
                                        valid = false;
                                        document.querySelector(".erroredit-answer").innerHTML = "Please select the correct answer";
                                    } else {
                                        document.querySelector(".erroredit-answer").innerHTML = "";
                                    }

                                    // Validate correct answer
                                    if (marks.length === 0) {
                                        valid = false;
                                        document.querySelector(".erroredit-marks").innerHTML = "Please enter marks";
                                    } else {
                                        document.querySelector(".erroredit-marks").innerHTML = "";
                                    }

                                    if (valid) {
                                        // var form = document.querySelector("#updatequestion");
                                        // var formData = new FormData(form);
                                        // console.log(formData)
                                        var formdata = new FormData();
                                        formdata.append("question", question);
                                        formdata.append("op1", op1);
                                        formdata.append("op2", op2);
                                        formdata.append("op3", op3);
                                        formdata.append("op4", op4);
                                        formdata.append("rightanswer", rightanswer);
                                        formdata.append("marks", marks);
                                        formdata.append("id", id);
                                        var xhr = new XMLHttpRequest();
                                        xhr.open("POST", "codes/update-question.php", true);
                                        xhr.onreadystatechange = function() {
                                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                                if (xhr.status === 200) {
                                                    // console.log(xhr.response);
                                                    var resp = JSON.parse(xhr.response);
                                                    //  console.log(resp.status);
                                                    if (resp.success === 'Updated successfully') {
                                                        document.querySelector("#sucessmsgquestedit").innerHTML = resp.success;
                                                        // document.getElementById("savequestion").reset();
                                                        allquestiosns();
                                                    }

                                                    if (resp.error) {
                                                        document.querySelector("#sucessmsgquestedit").innerHTML = resp.error;
                                                    }

                                                } else {
                                                    console.log("Error")
                                                }
                                            }
                                        }
                                        xhr.send(formdata);

                                    } else {
                                        console.log("Form is invalid!");
                                    }
                                })


                            }

                        });
                    })

                } else {
                    console.log("Error: " + xhr.status);
                }
            }
        }
        xhr.send("id=" + encodeURIComponent(id));



    }
</script>
<?php
include('script.php');
?>