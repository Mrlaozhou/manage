select `manage_rp`.`puuid`, `manage_rp`.`ruuid`, `manage_ar`.`auuid`, `manage_p`.`name` as `pname`, `manage_p`.`route`, `manage_p`.`alias` as `palias`, `manage_p`.`mode`, `manage_p`.`pid`, `manage_p`.`type` as `ptype`, `manage_p`.`style` as `pstyle`, `manage_r`.`name` as `rname`
from `manage_privilege` as `manage_p`
left join `manage_relation2` as `manage_rp` on `manage_p`.`uuid` = `manage_rp`.`puuid`
left join `manage_role` as `manage_r` on `manage_r`.`uuid` = `manage_rp`.`ruuid`
left join `manage_relation1` as `manage_ar` on `manage_r`.`uuid` = `manage_ar`.`ruuid`
left join `manage_admin` as `manage_a` on `manage_a`.`uuid` = `manage_ar`.`auuid`
where (`manage_p`.`status` = '1')
and `manage_p`.`style` in (4, 5, 6, 7)
order by `manage_p`.`createdtime` asc