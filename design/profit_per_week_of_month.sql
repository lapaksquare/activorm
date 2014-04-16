SELECT
   sum(order_total_price) as profit,
   week,
   month,
   year
FROM(
   SELECT
      ocd.order_total_price,
      CEIL(DAY(op.payment_date)/7) as "week",
      MONTH(op.payment_date) as "month",
      YEAR(op.payment_date) as "year"
   FROM
      sales__rel_responsibility srr
      JOIN order__cart oc ON srr.account_id = oc.account_id
         AND order_status = 'completed'
      JOIN order__cart_detail ocd ON oc.order_id = ocd.order_id
      JOIN order__payment op ON oc.order_id = op.order_id
         AND op.payment_amount >= oc.order_total_price
   WHERE
      srr.sales_id = 22
) a
GROUP BY week, month, year
ORDER BY year ASC, month ASC, week ASC