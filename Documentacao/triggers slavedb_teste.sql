
/*TRIGGER PARA QUANDO FOR REALIZADO UM INSERT NA TABELA stock_input_product 
ALTERA VALOR E QUANTIDADE NA TABELA stock_products*/
DELIMITER $$
 
CREATE TRIGGER Tgr_stock_input_products_Insert AFTER INSERT
ON  stock_input_products
FOR EACH ROW
BEGIN
    UPDATE stock_products sp SET   sp.unit_price = NEW.unit_price_input , sp.amount = sp.amount + NEW.amount_input
WHERE sp.id_product = NEW.id_product;
END$$
 
 
DELIMITER ;

/*TRIGGER PARA QUANDO FOR REALIZADO UM DELETE NA TABELA stock_input_product 
ALTERA VALOR E QUANTIDADE NA TABELA stock_products*/
DELIMITER $$
 
CREATE TRIGGER Tgr_stock_input_products_delete AFTER delete
ON  stock_input_products
FOR EACH ROW
BEGIN
    UPDATE stock_products sp SET   sp.unit_price = OLD.unit_price_input , sp.amount = sp.amount - OLD.amount_input
WHERE sp.id_product = OLD.id_product;
END$$
 
 
DELIMITER ;



/*TRIGGER PARA QUANDO FOR REALIZADO UM UPDATE NA TABELA stock_input_product 
ALTERA VALOR E QUANTIDADE NA TABELA stock_products*/
DELIMITER $$
 
CREATE TRIGGER Tgr_stock_input_products_update AFTER update
ON  stock_input_products
FOR EACH ROW
BEGIN
	IF NEW.amount_input >= OLD.amount_input THEN

		UPDATE stock_products sp SET   sp.unit_price = NEW.unit_price_input ,
		sp.amount = sp.amount + (NEW.amount_input -OLD.amount_input) 
		WHERE sp.id_product = OLD.id_product;

	ELSEIF NEW.amount_input < OLD.amount_input THEN

		UPDATE stock_products sp SET   sp.unit_price = NEW.unit_price_input ,
		sp.amount = sp.amount - (OLD.amount_input -NEW.amount_input) 
		WHERE sp.id_product = OLD.id_product;

	END IF;
END$$

 

DELIMITER ;

/*TRIGGER PARA SOMAR O VALOR DE ESTOQUE NA TABELA stock_input QUANDO REALIZAR INSERT na tabela stock_input_products*/

DELIMITER $$
 
CREATE TRIGGER Tgr_sum_insert AFTER INSERT 
ON  stock_input_products
FOR EACH ROW
BEGIN
	DECLARE total DECIMAL (18,2);

		SELECT unit_price_input * amount_input INTO total FROM stock_input_products sp WHERE sp.id_product = NEW.id_product;
		UPDATE stock_input si SET si.sum_value = total WHERE si.id_product = NEW.id_product;
		
				
END$$
 
 
DELIMITER ;

/*TRIGGER PARA SOMAR O VALOR DE ESTOQUE NA TABELA stock_input QUANDO REALIZAR UPDATE na tabela stock_input_products*/

DELIMITER $$
 
CREATE TRIGGER Tgr_sum_update AFTER UPDATE 
ON  stock_input_products
FOR EACH ROW
BEGIN
	DECLARE total DECIMAL (18,2);

		SELECT unit_price_input * amount_input INTO total FROM stock_input_products sp WHERE sp.id_product = NEW.id_product;
		UPDATE stock_input si SET si.sum_value = total WHERE si.id_product = NEW.id_product;
		
				
END$$
 
 
DELIMITER ;

/*TRIGGER PARA SOMAR O VALOR DE ESTOQUE NA TABELA stock_input QUANDO REALIZAR INSERT na tabela stock_input_products*/

DELIMITER $$
 
CREATE TRIGGER Tgr_sum_delete AFTER DELETE
ON  stock_input_products
FOR EACH ROW
BEGIN
	DECLARE total DECIMAL (18,2);

		SELECT unit_price_input * amount_input INTO total FROM stock_input_products sp WHERE sp.id_product = OLD.id_product;
		UPDATE stock_input si SET si.sum_value = total WHERE si.id_product = OLD.id_product;
		
				
END$$
 
 
DELIMITER ;




/*TRIGGER TABELAS OUTPUT*/





/*TRIGGER PARA QUANDO FOR REALIZADO UM INSERT NA TABELA stock_output_product 
ALTERA VALOR E QUANTIDADE NA TABELA stock_products*/

DELIMITER $$
 
CREATE TRIGGER Tgr_stock_output_products_Insert AFTER INSERT
ON  stock_output_products
FOR EACH ROW
BEGIN

    UPDATE stock_products sp SET  sp.unit_price = NEW.unit_price_output, sp.amount = sp.amount - NEW.amount_output
	WHERE sp.id_product = NEW.id_product;
END$$
 
 
DELIMITER ;


/*TRIGGER PARA QUANDO FOR REALIZADO UM DELETE NA TABELA stock_output_product 
ALTERA VALOR E QUANTIDADE NA TABELA stock_products*/

DELIMITER $$
 
CREATE TRIGGER Tgr_stock_output_products_Delete AFTER DELETE
ON  stock_output_products
FOR EACH ROW
BEGIN
	

    UPDATE stock_products sp SET  sp.unit_price = OLD.unit_price_output, sp.amount = sp.amount + OLD.amount_output
	WHERE sp.id_product = OLD.id_product;
END$$
 
 
DELIMITER ;



/*TRIGGER PARA QUANDO FOR REALIZADO UM UPDATE NA TABELA stock_output_product 
ALTERA VALOR E QUANTIDADE NA TABELA stock_products*/
DELIMITER $$
 
CREATE TRIGGER Tgr_stock_output_products_Update AFTER UPDATE
ON  stock_output_products
FOR EACH ROW
BEGIN

	
	IF NEW.amount_output >= OLD.amount_output THEN

		UPDATE stock_products sp SET  sp.unit_price = NEW.unit_price_output ,
		sp.amount = sp.amount - (NEW.amount_output -OLD.amount_output) 
		WHERE sp.id_product = OLD.id_product;

	ELSEIF NEW.amount_output < OLD.amount_output THEN

		UPDATE stock_products sp SET   sp.unit_price = NEW.unit_price_output , 
		sp.amount = sp.amount + (OLD.amount_output -NEW.amount_output) 
		WHERE sp.id_product = OLD.id_product;

	END IF;
END$$

 
DELIMITER ;























/*comando para habilitar os updates SET sql_safe_updates=0/*

/*TRIGGER PARA QUANDO FOR REALIZADO UM DELETE NA TABELA stock_products 
REALIZAR UM INSERT NA TABELA stock_output_products e stock_output
DELIMITER $$
 
CREATE TRIGGER Tgr_products_delete AFTER DELETE 
ON  stock_products
FOR EACH ROW 
BEGIN
   DECLARE id int ;

	INSERT INTO stock_output ( output_date) VALUES ( CURDATE() );
		SELECT MAX(id_stock) INTO id FROM stock_output;
			INSERT INTO stock_output_products VALUES (OLD.id_product, id, OLD.unit_price, OLD.amount);
END$$

 
DELIMITER ;

*/



