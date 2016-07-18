


<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html">
<meta http-equiv="cache-control" content="max-age=0" />
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
<meta http-equiv="pragma" content="no-cache" />
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%@ page import="java.io.*"%>
<%
			 String URL=request.getParameter("url");
			 String nombre_fichero=request.getParameter("nombreFichero");
			 String ext=request.getParameter("ext");
			 
			 FileInputStream archivo = new FileInputStream(URL);
			 int longitud = archivo.available();
			 byte[] datos = new byte[longitud];
			 archivo.read(datos,0,longitud);
			 
			 
			 archivo.close();

		
	
%>

</head>
<body>

</body>
</html>