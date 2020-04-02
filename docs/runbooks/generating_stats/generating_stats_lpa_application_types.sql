-- Query for LPA types
SELECT COUNT(1),
    applications."document"->>'type' AS "Type",
	TO_CHAR(applications."completedAt", 'Mon') AS "Mon",
	TO_CHAR(applications."completedAt", 'YYYY') AS "Yr"
FROM applications
WHERE
	applications."completedAt" BETWEEN '2019-01-01 00:00:00' AND '2020-03-31 23:59:59'
GROUP BY
	2,
	3,
	4;