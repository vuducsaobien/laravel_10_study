SET @userId = 29;

SELECT * FROM users WHERE id = @userId; 			-- 1

-- B
START TRANSACTION;

SELECT * FROM users WHERE id = @userId FOR UPDATE; 	-- 2
SELECT SLEEP(15);									-- 3

COMMIT;

-- C
SELECT * FROM users WHERE id = @userId;				-- 4

