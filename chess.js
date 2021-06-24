var position_zero = new Array(64);
var numbers = new Array();
var IN_MOVE_FLAG = false;
var piece_name="";
var present_position = new Array(64);
var WHITE_VIEW_FLAG = true;
var players_moves = new Array();
players_moves = [];

position_zero = ["&#x265C;", "&#x265E;", "&#x265D;", "&#x265B;", "&#x265A;", "&#x265D;", "&#x265E;", "&#x265C;",
"&#x265F;", "&#x265F;", "&#x265F;", "&#x265F;", "&#x265F;", "&#x265F;", "&#x265F;", "&#x265F;",
"", "", "", "", "", "", "", "", 
"", "", "", "", "", "", "", "", 
"", "", "", "", "", "", "", "", 
"", "", "", "", "", "", "", "", 
"&#x2659;", "&#x2659;", "&#x2659;", "&#x2659;", "&#x2659;", "&#x2659;", "&#x2659;", "&#x2659;",
"&#x2656;", "&#x2658;", "&#x2657;", "&#x2655;", "&#x2654;", "&#x2657;", "&#x2658;", "&#x2656;"];

function loadChessboardWhite(){
	var kod_html="";
	document.getElementById("board").innerHTML=kod_html;
	for(i=0; i<64; i++)
	{
		if(i<8 || (i>=16 && i<24) || (i>=32 && i<40) || (i>=48 && i<56) )
		{
			if(i%2==0)
			{
				kod_html = kod_html + '<div class="wsquare" id="'+i+'" onclick="movePiece('+i+')"></div>';
			}	
			else
			{
				kod_html = kod_html + '<div class="bsquare" id="'+i+'" onclick="movePiece('+i+')"></div>';
			}
		}
		else
		{
			if(i%2==0)
			{
				kod_html = kod_html + '<div class="bsquare" id="'+i+'" onclick="movePiece('+i+')"></div>';
			}	
			else
			{
				kod_html = kod_html + '<div class="wsquare" id="'+i+'" onclick="movePiece('+i+')"></div>';
			}	
		}
	}
	document.getElementById("board").innerHTML=kod_html;
}

function loadChessboardBlack()
{
	var kod_html = "";
	document.getElementById("board").innerHTML=kod_html;
	for(i=63; i>=0; i--)
	{
		if(i<8 || (i>=16 && i<24) || (i>=32 && i<40) || (i>=48 && i<56) )
		{
			if(i%2==0)
			{
				kod_html = kod_html + '<div class="wsquare" id="'+i+'" onclick="movePiece('+i+')"></div>';
			}	
			else
			{
				kod_html = kod_html + '<div class="bsquare" id="'+i+'" onclick="movePiece('+i+')"></div>';
			}
		}
		else
		{
			if(i%2==0)
			{
				kod_html = kod_html + '<div class="bsquare" id="'+i+'" onclick="movePiece('+i+')"></div>';
			}	
			else
			{
				kod_html = kod_html + '<div class="wsquare" id="'+i+'" onclick="movePiece('+i+')"></div>';
			}	
		}
	}
	document.getElementById("board").innerHTML=kod_html;
}

function setPiecesInitialPosition()
{
	for(i=0; i<64; i++)
	{
		document.getElementById(i).innerHTML=position_zero[i];
	}
}

function startNewGame()
{
	loadChessboardWhite();
	setPiecesInitialPosition();
	document.getElementById("hand").innerHTML = "";
	players_moves = [];
}

function getPresentPossition()
{
	for(i=0; i<64; i++)
	{
		present_position[i]=document.getElementById(i).textContent
	}
}

function setPresentPosition()
{
	for(i=0; i<64; i++)
	{
		document.getElementById(i).innerHTML=present_position[i];
	}
}

function rotateBoard()
{
	if(WHITE_VIEW_FLAG)
	{
		getPresentPossition();
		loadChessboardBlack();
		setPresentPosition();
		WHITE_VIEW_FLAG=false;
	}
	else
	{
		getPresentPossition();
		loadChessboardWhite();
		setPresentPosition();
		WHITE_VIEW_FLAG=true;
	}
}

function showNumbers()
{
	for(i=0; i<64; i++)
	{
		document.getElementById(i).innerHTML=i;
	}
}

function movePiece(id)
{
	if(!IN_MOVE_FLAG)
	{
		piece_name = document.getElementById(id).textContent;
		document.getElementById(id).innerHTML="";
		IN_MOVE_FLAG = true;
		document.getElementById("hand").innerHTML = piece_name;
		players_moves.push(id);
	}
	else /* IN_MOVE_FLAG = true */
	{
		document.getElementById(id).innerHTML = piece_name;
		IN_MOVE_FLAG = false;
		document.getElementById("hand").innerHTML = "";
		players_moves.push(id);
	}
}

function takeBack()
{
	if(players_moves.length<=0)
	{
		alert('Nie ma ruchów do cofnięcia');
	}
	else
	{
		var id = players_moves.pop();
		if(!IN_MOVE_FLAG) /*the piece is on the board*/
		{
			piece_name = document.getElementById(id).textContent;
			document.getElementById(id).innerHTML = "";
			document.getElementById("hand").innerHTML = piece_name;
			IN_MOVE_FLAG = true;
		}
		else /*the is piece in the hand*/
		{
			piece_name = document.getElementById("hand").textContent; 
			document.getElementById("hand").innerHTML = "";
			document.getElementById(id).innerHTML = piece_name;
			IN_MOVE_FLAG = false;
		}
	}	
}

function saveNewSequence()
{
	if(players_moves.length<=0)
	{
		alert('Sekwencja jest pusta, nie można dokonać zapisu.');
	}	
	else 
	{
		// CONFIRM BOX
		if(window.confirm("Zapisać sekwencję?"))
		{	//OK button
			// PROMPT BOX
			var debut_name = window.prompt("Wpisz nazwę debiutu.","");
			if(debut_name == null || debut_name == "")
			{ // EMPTY PROMT BOX
				alert("Zapis anulowany. Nie podałeś nazwy debiutu");
				/* do nothing */
			}
			else // FILLED PROMT BOX
			{
				/* CREATE OBJECT WITH DEBUT DATA */
				var debut_data = {};
				debut_data.name = debut_name;
				debut_data.author = "Pawel";	/* UZUPEŁNIĆ !!! */
				debut_data.sequence = players_moves;
				console.log(debut_data);
				/* SENDING DATA FORM JS TO readJson.php */
				/* AJAX read/save data to DB without refreshing browser */
				$.ajax({ /* jQuery script works here: */
					url: "readJson.php",
					method: "post",
					data: {debut_data : JSON.stringify(debut_data)},
					success: function(res){
						console.log(res);
					}
				})
			}
		}
		else
		{	//CANCEL button
			/* do nothing */
		}
	}
}