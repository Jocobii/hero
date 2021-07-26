select CONCAT_WS(' ',t.Fecha_registro,t.Hora_registro) as fecha ,CONCAT_WS(' ',t.Fecha_meta,t.Hora_meta) as fechameta, t.*
                FROM tickets t
                where  (year(str_to_date(t.Fecha_registro,'%d/%m/%Y')) = 2019) 
                ORDER BY t.Folio DESC;