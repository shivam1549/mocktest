const questions = [
    {
        "id": 1,
        "quest": "What is the full form of PHP?",
        "op1": "Hypertext Preprocessor",
        "op2": "Hypertext Programming",
        "op3": "Personal Home Page",
        "op4": "Programming Hypertext Processor",
        "state": "unanswered",
        "selectedans": null
    },
    {
        "id": 2,
        "quest": "Which programming language is used for front-end web development?",
        "op1": "JavaScript",
        "op2": "Python",
        "op3": "Java",
        "op4": "C++",
        "state": "unanswered",
        "selectedans": null
    },
    {
        "id": 3,
        "quest": "What does HTML stand for?",
        "op1": "Hypertext Markup Language",
        "op2": "Hyper Textual Markup Language",
        "op3": "High Text Markup Language",
        "op4": "Hyperlink Text Markup Language",
        "state": "unanswered",
        "selectedans": null
    },
    {
        "id": 4,
        "quest": "Which of the following is NOT a programming language?",
        "op1": "Java",
        "op2": "HTML",
        "op3": "Ruby",
        "op4": "C++",
        "state": "unanswered",
        "selectedans": null
    },
    {
        "id": 5,
        "quest": "What is the capital of France?",
        "op1": "London",
        "op2": "Berlin",
        "op3": "Madrid",
        "op4": "Paris",
        "state": "unanswered",
        "selectedans": null
    },
    {
        "id": 6,
        "quest": "Which of the following is a CSS framework?",
        "op1": "React",
        "op2": "Angular",
        "op3": "Bootstrap",
        "op4": "Node.js",
        "state": "unanswered",
        "selectedans": null
    },
    {
        "id": 7,
        "quest": "Who is the CEO of Tesla?",
        "op1": "Jeff Bezos",
        "op2": "Bill Gates",
        "op3": "Elon Musk",
        "op4": "Mark Zuckerberg",
        "state": "unanswered",
        "selectedans": null
    },
    {
        "id": 8,
        "quest": "What year was JavaScript created?",
        "op1": "1995",
        "op2": "2000",
        "op3": "2005",
        "op4": "2010",
        "state": "unanswered",
        "selectedans": null
    },
    {
        "id": 9,
        "quest": "What is the chemical symbol for water?",
        "op1": "H",
        "op2": "O2",
        "op3": "H2O",
        "op4": "HO",
        "state": "unanswered",
        "selectedans": null
    },
    {
        "id": 10,
        "quest": "Which planet is known as the Red Planet?",
        "op1": "Earth",
        "op2": "Mars",
        "op3": "Jupiter",
        "op4": "Saturn",
        "state": "unanswered",
        "selectedans": null
    }
];

// console.log(questions[0])

function loadquestions(i){
    var html ="";
    // alert(i)
    // console.log(questions[i])
// questions.forEach(element => {
    html += "<div class='card quest-card'>"
   
    html += "<div class='card-body'>"
    html += "<p class='card-title'>"+questions[i].quest+"</p>"
    html += "<div class='form-check'><input data-questid='"+questions[i].id+"' value='"+questions[i].op1+"' type='radio' class='form-check-input radioopt'><label>" +questions[i].op1+ "</label></div>"
    html += "<div class='form-check'><input data-questid='"+questions[i].id+"' value='"+questions[i].op2+"' type='radio' class='form-check-input radioopt'><label>" +questions[i].op2+ "</label></div>"
    html += "<div class='form-check'><input data-questid='"+questions[i].id+"' value='"+questions[i].op3+"' type='radio' class='form-check-input radioopt'><label>" +questions[i].op3+ "</label></div>"
    html += "<div class='form-check'><input data-questid='"+questions[i].id+"' value='"+questions[i].op4+"' type='radio' class='form-check-input radioopt'><label>" +questions[i].op4+ "</label></div>"
    html += "</div></div>"
// });
document.querySelector("#container").innerHTML = html;
if(i === 0){
    document.querySelector("#previous").style.display = "none";  
}
else{
    document.querySelector("#previous").style.display = "inline-block";   
}
if(i != questions.length - 1){
    document.querySelector("#next").style.display = "inline-block";   
}
else{
    document.querySelector("#next").style.display = "none";
}
}
var noquest = 0;
loadquestions(noquest)


document.querySelector("#next").addEventListener("click", function(){
    // alert("dd")
    noquest = noquest + 1;
    // console.log(noquest)
    loadquestions(noquest);
})

document.querySelector("#previous").addEventListener("click", function(){
    // alert("dd")
    noquest = noquest - 1;
    // console.log(noquest)
    loadquestions(noquest);
})

document.querySelector("#savenext").addEventListener("click", function(){
    // alert("he")
    var checkedValue ='';
    var questid = '';
    document.querySelectorAll(".radioopt").forEach(element => {
            // console.log(element.value)
            if(element.checked){
                checkedValue  = element.value;
                questid = element.getAttribute("data-questid");
            }
    })

    const questionsidindex = questions.findIndex(question => question.id == parseInt(questid));
    // console.log(questionsid);
    questions[questionsidindex].selectedans = checkedValue;
    console.log(questions);
    // console.log(questid);

})

// console.log(questions); // Check the structure of the questions object
