DELIMITER //
CREATE PROCEDURE TarifaCiclo(IN userId INT)
BEGIN
    SELECT u.idtarifa, u.ciclo_facturacion
    FROM users u 
    WHERE u.id = userId;
END //
DELIMITER ;

CALL TarifaCiclo(1);