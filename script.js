// const questions = [
//     {
//         "id": 1,
//         "quest": "What is the full form of PHP?",
//         "op1": "Hypertext Preprocessor",
//         "op2": "Hypertext Programming",
//         "op3": "Personal Home Page",
//         "op4": "Programming Hypertext Processor",
//         "answer": "op1",
//         "state": null,
//         "selectedans": null
//     },
//     {
//         "id": 2,
//         "quest": "Which programming language is used for front-end web development?",
//         "op1": "JavaScript",
//         "op2": "Python",
//         "op3": "Java",
//         "op4": "C++",
//         "answer": "op1",
//         "state": null,
//         "selectedans": null
//     },
//     {
//         "id": 3,
//         "quest": "What does HTML stand for?",
//         "op1": "Hypertext Markup Language",
//         "op2": "Hyper Textual Markup Language",
//         "op3": "High Text Markup Language",
//         "op4": "Hyperlink Text Markup Language",
//         "answer": "op1",
//         "state": null,
//         "selectedans": null
//     },
//     {
//         "id": 4,
//         "quest": "Which of the following is NOT a programming language?",
//         "op1": "Java",
//         "op2": "HTML",
//         "op3": "Ruby",
//         "op4": "C++",
//         "answer": "op2",
//         "state": null,
//         "selectedans": null
//     },
//     {
//         "id": 5,
//         "quest": "What is the capital of France?",
//         "op1": "London",
//         "op2": "Berlin",
//         "op3": "Madrid",
//         "op4": "Paris",
//         "answer": "op4",
//         "state": null,
//         "selectedans": null
//     },
//     {
//         "id": 6,
//         "quest": "Which of the following is a CSS framework?",
//         "op1": "React",
//         "op2": "Angular",
//         "op3": "Bootstrap",
//         "op4": "Node.js",
//         "answer": "op3",
//         "state": null,
//         "selectedans": null
//     },
//     {
//         "id": 7,
//         "quest": "Who is the CEO of Tesla?",
//         "op1": "Jeff Bezos",
//         "op2": "Bill Gates",
//         "op3": "Elon Musk",
//         "op4": "Mark Zuckerberg",
//         "answer": "op3",
//         "state": null,
//         "selectedans": null
//     },
//     {
//         "id": 8,
//         "quest": "What year was JavaScript created?",
//         "op1": "1995",
//         "op2": "2000",
//         "op3": "2005",
//         "op4": "2010",
//         "answer": "op1",
//         "state": null,
//         "selectedans": null
//     },
//     {
//         "id": 9,
//         "quest": "What is the chemical symbol for water?",
//         "op1": "H",
//         "op2": "O2",
//         "op3": "H2O",
//         "op4": "HO",
//         "answer": "op3",
//         "state": null,
//         "selectedans": null
//     },
//     {
//         "id": 10,
//         "quest": "Which planet is known as the Red Planet?",
//         "op1": "Earth",
//         "op2": "Mars",
//         "op3": "Jupiter",
//         "op4": "Saturn",
//         "answer": "op2",
//         "state": null,
//         "selectedans": null
//     }
// ];

// console.log(questions[0])



// console.log(questions);
// You can now use the 'questions' array here

allQuestions()
.then(res => {
    const questions = res;



function loadquestions(i) {
    var html = "";

    // console.log(questions[i])
    // questions.forEach(element => {

    if (i >= questions.length) {
        // alert(i - 1);
        var markers = '';
        var quesindex = 0
        markers += "<div class='row'>"
        questions.forEach(element => {
            markers += "<div class='col-md-2 mb-2'>"
            markers += "<div data-questindex='" + quesindex + "' " + (element.state && element.state == 'answered' ? 'style="background-color:green"' : '') + " " + (element.state && element.state == 'unanswered' ? 'style="background-color:red"' : '') + " " + (element.state && element.state == 'markedreview' ? 'style="background-color:purple"' : '') + " class='border text-center p-2 navquestions'>" + element.id + "</div>"
            markers += "</div>"
            quesindex++;
        });
        markers += "</div>"
        document.querySelector("#markers").innerHTML = markers;

        return false;
    }

    html += "<div class='card quest-card' data-questid='" + questions[i].id + "'>"

    html += "<div class='card-body'>"
    html += "<p class='card-title'>(" + questions[i].id + ") " + questions[i].quest + "</p>"
    html += "<div class='form-check'><input " + (questions[i].selectedans && questions[i].selectedans == 'op1' ? 'checked' : '') + " data-questid='" + questions[i].id + "' value='op1' type='radio' class='form-check-input radioopt'><label>" + questions[i].op1 + "</label></div>"
    html += "<div class='form-check'><input " + (questions[i].selectedans && questions[i].selectedans == 'op2' ? 'checked' : '') + " data-questid='" + questions[i].id + "' value='op2' type='radio' class='form-check-input radioopt'><label>" + questions[i].op2 + "</label></div>"
    html += "<div class='form-check'><input " + (questions[i].selectedans && questions[i].selectedans == 'op3' ? 'checked' : '') + " data-questid='" + questions[i].id + "' value='op3' type='radio' class='form-check-input radioopt'><label>" + questions[i].op3 + "</label></div>"
    html += "<div class='form-check'><input " + (questions[i].selectedans && questions[i].selectedans == 'op4' ? 'checked' : '') + " data-questid='" + questions[i].id + "' value='op4' type='radio' class='form-check-input radioopt'><label>" + questions[i].op4 + "</label></div>"
    html += "</div></div>"

    // });
    document.querySelector("#container").innerHTML = html;
    if (i === 0) {
        document.querySelector("#previous").style.display = "none";
    }
    else {
        document.querySelector("#previous").style.display = "inline-block";
    }
    if (i != questions.length - 1) {
        document.querySelector("#next").style.display = "inline-block";
        document.querySelector("#marknext").style.display = "inline-block";
        document.querySelector("#savenext").style.display = "inline-block";
    }
    else {
        document.querySelector("#next").style.display = "none";
        // document.querySelector("#marknext").style.display = "none";
        // document.querySelector("#savenext").innerHTML = "Save";


    }


    // load markers
    var markers = '';
    var quesindex = 0
    markers += "<div class='row'>"
    // console.log(questions);
    questions.forEach(element => {
        console.log(element.id)
        markers += "<div class='col-md-2 mb-2'>"
        markers += "<div data-questindex='" + quesindex + "' " + (element.state && element.state == 'answered' ? 'style="background-color:green"' : '') + " " + (element.state && element.state == 'unanswered' ? 'style="background-color:red"' : '') + " " + (element.state && element.state == 'markedreview' ? 'style="background-color:purple"' : '') + " class='border text-center p-2 navquestions'>" + element.id + "</div>"
        markers += "</div>"
        quesindex++;
    });
    markers += "</div>"
    document.querySelector("#markers").innerHTML = markers;


    var navqustions = document.querySelectorAll(".navquestions");
    navqustions.forEach(function (element) {
        questions[i].state == null ? questions[i].state = "unanswered" : '';
        element.addEventListener("click", function () {
            var questionindex = this.getAttribute("data-questindex");
            //    console.log(questionindex)
            // i = questionindex;
            noquest = parseInt(questionindex);
            //    console.log(noquest + "hfh")
            loadquestions(questionindex);
        })
    })
// Save question in server
    return new Promise((resolve, reject) => {
      

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "codes/savequestion.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    
                } else {
                    reject("Error: " + xhr.status);
                }
            }
        };
        const questionsStr = encodeURIComponent(JSON.stringify(questions));
        xhr.send("questions=" + questionsStr);
    });
}
var noquest = 0;
loadquestions(noquest)

// Next questions
document.querySelector("#next").addEventListener("click", function () {
    // alert("dd")
    var questid = document.querySelector(".quest-card").getAttribute("data-questid");
    // console.log(questid);
    const questionsidindex = questions.findIndex(question => question.id == parseInt(questid));
    console.log(questions[questionsidindex].state);

    questions[questionsidindex].state == null ? questions[questionsidindex].state = "unanswered" : '';
    // questions[questionsidindex].state == "markedreview" ?  "" : '';
    noquest = noquest + 1;
    // console.log(noquest + "net")
    loadquestions(noquest);
})
// previos questions
document.querySelector("#previous").addEventListener("click", function () {
    // alert("dd")
    var questid = document.querySelector(".quest-card").getAttribute("data-questid");
    console.log(questid);
    const questionsidindex = questions.findIndex(question => question.id == parseInt(questid));
    questions[questionsidindex].state == null ? questions[questionsidindex].state = "unanswered" : '';
    noquest = noquest - 1;
    // console.log(noquest)
    loadquestions(noquest);
})
// Save qustion and next
document.querySelector("#savenext").addEventListener("click", function () {
    // alert("he")
    var checkedValue = '';
    var questid = '';
    document.querySelectorAll(".radioopt").forEach(element => {
        // console.log(element.value)
        if (element.checked) {
            checkedValue = element.value;
            questid = element.getAttribute("data-questid");
        }

    })
    if (checkedValue === '') {
        alert("please select at least one value");
        return false;

    }
    const questionsidindex = questions.findIndex(question => question.id == parseInt(questid));
    // console.log(questionsid);
    questions[questionsidindex].selectedans = checkedValue;
    questions[questionsidindex].state = "answered";
    console.log(questions);
    // console.log(questid);
    if (noquest < questions.length - 1) {
        noquest = noquest + 1;
    }
    // alert(noquest)
    // console.log(noquest)
    loadquestions(noquest);

})

document.querySelector("#marknext").addEventListener("click", function () {
    var questid = document.querySelector(".quest-card").getAttribute("data-questid");
    console.log(questid);
    const questionsidindex = questions.findIndex(question => question.id == parseInt(questid));
    questions[questionsidindex].state = "markedreview";
    noquest = noquest + 1;
    // console.log(noquest)
    loadquestions(noquest);
    console.log(questions);
})


document.querySelector("#submittest").addEventListener("click", function () {

    var userConfirmed = confirm("Are you sure want to submit?");

    if (userConfirmed) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "test-end.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var resp = JSON.parse(xhr.response);
                    if (resp.message == 'Test details saved successfully') {
                       location.href="my-profile.php";
                    }
                   
                } else {
                    location.href="/";
                    console.error("Error: " + xhr.status);
                }
            }
        };
        xhr.send();
    }

    document.querySelector("#container").innerHTML = '';
    document.querySelector("#markers").innerHTML = '';
    document.querySelector("#questionconatiner").innerHTML = '';


    const getmarks = calculateMarks();
    const totalmarks = questions.length;

    var marks = "<h2 class='text-center'><span style='color:green'>" + getmarks + "</span>Out of" + totalmarks + "</h2>";

    document.querySelector("#obtmarks").innerHTML = marks;


})

function calculateMarks() {
    var marks = 0;
    console.log(questions)
    questions.forEach(element => {
        if (element.answer === element.selectedans) {
            marks++;
        }
    })
    return marks;
}

})
.catch(err => {
    console.error(err);
});




// Navigation question load



// console.log(questions); // Check the structure of the questions object
