<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div class="container">
		<h2> TRACK YOUR COURSES </h2>
		<div id="csv-display"></div>
	</div>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

	<script type="text/javascript">

	var data;
		$.ajax({
		  type: "GET",  
		  url: "course.csv",
		  dataType: "text",       
		  success: function(response)  
		  {
			data = $.csv.toArrays(response);
			generateHtmlTable(data);
		  }   
		});
		
		function generateHtmlTable(data) {
	    var html = '<table  class="table">';

	      if(typeof(data[0]) === 'undefined') {
	        return null;
	      } else {
			$.each(data, function( index, row ) {
			  //bind header
			  if(index == 0) {
				html += '<thead>';
				html += '<tr>';
				$.each(row, function( index, colData ) {
					html += '<th>';
					html += colData;
					html += '</th>';
				});
				html += '</tr>';
				html += '</thead>';
				html += '<tbody>';
			  } else {
				html += '<tr>';
				$.each(row, function( index, colData ) {
					html += '<td>';
					html += colData;
					html += '</td>';
				});
				html += '</tr>';
			  }
			});
			html += '</tbody>';
			html += '</table>';
			
			$('#csv-display').append(html);
		  }
		}
		

	</script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-csv/1.0.8/jquery.csv.js"></script>


	<style type="text/css">
		.container {
			    margin: 1% 20%;
		}
		h2 {
			text-align: center;
		}
		table {
			  border-collapse: collapse;
			  width: 100%;
			}

		th {
			  background-color: #143146;
			  color: white;
			}

		th, td {
			  padding: 8px;
			  text-align: left;
			  border-bottom: 1px solid #ddd;
			}

		tr:hover {
				background-color:#f5f5f5;
			}

	</style>
</body>
</html>