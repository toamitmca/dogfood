-- --------------------------------------------------------
-- Host:                         192.168.1.22
-- Server version:               5.5.16 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.1.0.4867
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for trueexpence
CREATE DATABASE IF NOT EXISTS `expense_test` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `expense_test`;


-- Dumping structure for procedure trueexpence.emailvarify
DELIMITER //
CREATE  PROCEDURE `emailvarify`(IN myemail VARCHAR(255), IN mypass VARCHAR(255))
begin

UPDATE tbl_systemlogin SET
IsActive='Active'
WHERE t_username=myemail && t_password=mypass;


end//
DELIMITER ;


-- Dumping structure for function trueexpence.fn_GetCatName
DELIMITER //
CREATE  FUNCTION `fn_GetCatName`(n_CategoriesID int) RETURNS longtext CHARSET latin1
BEGIN
declare t_Name longtext;
set t_Name=(select t_CustCatName from tblcustomcategory where a_CustCatId=n_CreatedBy and b_Deleted=0);
RETURN t_Name;
END//
DELIMITER ;


-- Dumping structure for function trueexpence.fn_GetLoginName
DELIMITER //
CREATE  FUNCTION `fn_GetLoginName`(n_CreatedBy int,t_Type varchar(100)) RETURNS longtext CHARSET latin1
BEGIN
declare t_Name longtext;
if(Upper(t_Type)='ADMIN')
then
set t_Name=(select concat(t_FirstName,' ',t_LastName) from tbl_businessadmin where a_BusnAdminId=n_CreatedBy and b_Deleted=0);
end if;
if(Upper(t_Type)='EMPLOYEE')
then
set t_Name=(select concat(t_EmpFirstName,' ',t_EmpLastName) from tblemployeemaster where a_EmpId=n_CreatedBy and b_Deleted=0);
end if;
if(Upper(t_Type)='SYSTEMADMIN')
then
set t_Name=(select concat(FirstName,' ',LastName) from tbl_SystemLogin where a_SysloginId=n_CreatedBy and b_Deleted=0 );
end if;
RETURN t_Name;
END//
DELIMITER ;


-- Dumping structure for function trueexpence.fn_GetPolicyName
DELIMITER //
CREATE  FUNCTION `fn_GetPolicyName`(n_policyId int) RETURNS longtext CHARSET latin1
BEGIN
declare t_Name longtext;
set t_Name=(select t_PolicyName from tblpolicymaster where a_PolicyId=n_policyId and b_Deleted=0);
RETURN t_Name;
END//
DELIMITER ;


-- Dumping structure for function trueexpence.fn_GetRoleName
DELIMITER //
CREATE  FUNCTION `fn_GetRoleName`(n_RoleAccessId int) RETURNS longtext CHARSET latin1
BEGIN
declare t_Name longtext;
set t_Name=(select t_AccessName from tblroleaccess where a_RoleAccessId=n_RoleAccessId and b_Deleted=0);
RETURN t_Name;
END//
DELIMITER ;


-- Dumping structure for function trueexpence.fn_GetSpendCatName
DELIMITER //
CREATE  FUNCTION `fn_GetSpendCatName`(n_SpndngCatId int) RETURNS longtext CHARSET latin1
BEGIN
declare t_Name longtext;
set t_Name=(select t_SpndName from tblspndngcat where a_SpndngCatId=n_SpndngCatId and b_Deleted=0);
RETURN t_Name;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.prec_departmentadd
DELIMITER //
CREATE  PROCEDURE `prec_departmentadd`(IN dept_nam varchar(200), IN businessid int(10))
begin
insert into tbldepartment (`t_DeptName` ,`n_BusinessId`)  values(dept_nam,businessid);
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_AddbusinessData
DELIMITER //
CREATE  PROCEDURE `proc_AddbusinessData`(
IN `p_mode` varchar(20), 
IN `p_BusnAdminId` bigint(100),
IN `p_AdminCode` varchar(80),
IN `p_Email` varchar(50),
IN `p_pass` varchar(200),
IN `p_FirstName` varchar(80), 
IN `p_LastName` varchar(80),
IN `p_DeptId` int,
IN `p_Contact` varchar(150),
IN `p_Mobile` varchar(15),
IN `p_DOB` datetime,
IN `p_Address` varchar(20), 
IN `p_Country` int,
IN `p_State` int ,
IN `p_City` int,
IN `p_Pincode` varchar(15),    
IN `p_Positon` varchar(20),
IN `p_Status` bit,
IN `p_XmlDatatest` longtext,
IN `p_AmountRange` decimal(15,2),
IN `p_CompareValue` decimal(15,2),
IN `p_CreatedBy` int,
IN `p_BusinessId` int,
IN `p_AdminType` int
)
BEGIN
declare n_id bigint;
declare xml_testing longtext;
if(p_mode='Insert')
then
insert into tbl_businessadmin
(
t_AdminCode,t_Email,t_password,t_FirstName,t_LastName,n_DeptId,t_Contact,t_Mobile,d_DOB,tba_Address,
n_CountryId,n_StateId,n_CityId,t_Pincode,n_Positon,b_Status,d_CreatedOn,n_CreatedBy,
n_BusinessId,b_Deleted,n_AdminType
)values(
p_AdminCode,p_Email,p_pass,p_FirstName,p_LastName,p_DeptId,p_Contact,p_Mobile,p_DOB,p_Address,
p_Country,p_State,p_City,p_Pincode,p_Positon,p_Status,now(),p_CreatedBy,
p_BusinessId,0,p_AdminType
);
set n_id=Last_INSERT_ID();
set xml_testing= p_XmlDatatest;
 -- select xml_testing;
-- call proc_XmlInsert('tblDocProMap',p_t_ProductData,'t_ContainerSize,t_ContainerNo ,n_ProductId,n_BrandId, n_NetWt, n_Grosswt, n_UnitPrice,n_ProTotalAmt,n_DocTypeID,n_DocID,n_ExpLcId, n_ExpPiId,n_CreatedBy, d_CreatedOn,n_HostId,n_PaymentId',concat(p_n_DocTypeID,',',@n_BolID,',',p_n_ExpLcId,',',p_n_ExpPiId,',',p_n_CreatedBy,',',now(),',',p_n_HostId,',',p_a_PaymentId));                               
-- set @staticV = concat(@n_SIID,',',p_AmountRange,',',p_CompareValue,',',p_BusinessId,',',p_CreatedBy,',',now());
 call proc_XmlInsert('tblempaccessmap',
  xml_testing,
'n_RoleAccessId,
  n_EmpId,
  n_BusinessId,
  n_CreatedBy,
  n_AmtRange,
  t_CompareValue,
  d_CreatedOn'
  ,concat(n_id,',',p_BusinessId,',',p_CreatedBy,
  ',',p_AmountRange,
  ',',p_CompareValue,',',now()));                             
end if;
if(p_mode='Update')
then
update tbl_businessadmin set 
t_AdminCode=p_AdminCode,
t_Email=p_Email,
t_FirstName=p_FirstName,
t_LastName=p_LastName,
n_DeptId=p_DeptId,
t_Contact=p_Contact,
t_Mobile=p_Mobile,
d_DOB=p_DOB,
tba_Address=p_Address,
n_CountryId=p_Country,
n_StateId=p_State,
n_CityId=p_City,
t_Pincode=p_Pincode,
n_Positon=p_Positon,
b_Status=p_Status,
d_ModifiedOn=now(),
n_ModifiedBy=p_CreatedBy
where a_BusnAdminId=p_BusnAdminId and n_BusinessId=p_BusinessId;
SET sql_safe_updates=0;
delete from tblempaccessmap where n_EmpId=p_BusnAdminId and n_BusinessId=p_BusinessId;
set xml_testing= p_XmlDatatest;
 -- select xml_testing;
-- call proc_XmlInsert('tblDocProMap',p_t_ProductData,'t_ContainerSize,t_ContainerNo ,n_ProductId,n_BrandId, n_NetWt, n_Grosswt, n_UnitPrice,n_ProTotalAmt,n_DocTypeID,n_DocID,n_ExpLcId, n_ExpPiId,n_CreatedBy, d_CreatedOn,n_HostId,n_PaymentId',concat(p_n_DocTypeID,',',@n_BolID,',',p_n_ExpLcId,',',p_n_ExpPiId,',',p_n_CreatedBy,',',now(),',',p_n_HostId,',',p_a_PaymentId));                               
-- set @staticV = concat(@n_SIID,',',p_AmountRange,',',p_CompareValue,',',p_BusinessId,',',p_CreatedBy,',',now());
 call proc_XmlInsert('tblempaccessmap',
  xml_testing,
'n_RoleAccessId,
  n_EmpId,
  n_BusinessId,
  n_CreatedBy,
  n_AmtRange,
  t_CompareValue,
  d_CreatedOn'
  ,concat(p_BusnAdminId,',',p_BusinessId,',',p_CreatedBy,
  ',',p_AmountRange,
  ',',p_CompareValue,',',now()));   
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_AddbusinessNotes
DELIMITER //
CREATE  PROCEDURE `proc_AddbusinessNotes`(
IN `p_mode` varchar(20),
IN `p_noteId` bigint,
IN `p_reportId` bigint, 
IN `p_noteDesc` longtext,
IN `p_createdBy` int,
IN `p_type` ENUM('SystemAdmin','Admin','Employee')
)
begin
declare n_id bigint;
if(p_mode='insert')
then
insert into tblrptnote (n_ReportId,t_NoteDesc,d_CreatedOn,n_CreatedBy,b_Deleted,t_Type)
values
(p_reportId,p_noteDesc,now(),p_createdBy,0,p_type);
set n_id=Last_INSERT_ID();
SELECT n_id;
end if;
if(p_mode='delete')
then
update tblrptnote set
b_Deleted=1,
n_ModifiedBy=p_createdBy ,
d_ModifiedOn=now() 
where  a_NoteId=p_noteId;
end if;

end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_AddCity
DELIMITER //
CREATE  PROCEDURE `proc_AddCity`(
IN `p_mode` varchar(25), 
IN `p_id` int(10), 
IN `p_stateid` int(10), 
IN `p_cityName` varchar(255), 
IN `p_createdBy` varchar(255), 
IN `p_modifiedBy` int(11), 
IN `p_deleted` BIT, 
IN `p_admin` int(20)
)
BEGIN
if(p_mode='insert')
then
insert into tblcity (n_StateId,t_CityName,d_CreatedOn,n_CreatedBy,b_Deleted,n_AdminType)
values
(p_stateid,p_cityName,now(),p_createdBy,p_deleted,p_admin);
end if;
if(p_mode='update')
then
update tblcity set 
t_CityName=p_cityName,
n_StateId=p_stateid,
d_ModifiedOn=now(),
n_ModifiedBy=p_modifiedBy,
n_AdminType=p_admin where a_CityId=p_id and n_AdminType=p_admin;
end if;
if(p_mode='delete')
then
DELETE from tblcity where a_CityId=p_id and n_AdminType=p_admin;
end if; 
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_AddCountry
DELIMITER //
CREATE  PROCEDURE `proc_AddCountry`(
p_mode varchar(20),
p_CountryId bigint,
p_CountryName varchar(80),
p_AdminType int,
p_BusinessId int,
p_CreatedBy int 
)
BEGIN
if(p_mode='Insert')
then
insert  into  tblcountry
(
t_CountryName,
d_CreatedOn,
n_CreatedBy,
n_BusinessId,
n_AdminType
)
values
(
p_CountryName,
now(),
p_CreatedBy,
p_BusinessId,
p_AdminType
);
end if;
if(p_mode='Update')
then
update tblcountry set 
t_CountryName=p_CountryName,
d_ModifiedOn=now(),
n_ModifiedBy=p_CreatedBy,
n_AdminType=p_AdminType where a_CountryId=p_CountryId and n_BusinessId=p_BusinessId;
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_AddCurrency
DELIMITER //
CREATE  PROCEDURE `proc_AddCurrency`(IN `p_mode` varchar(25), IN `p_id` int(254), IN `p_countryId` int(11), IN `p_currencyName` varchar(50), IN `p_createdBy` BIGINT(254), IN `p_modifiedBy` BIGINT(254), IN `p_active` BIT(1), IN `p_businessId` int(254), IN `p_admin` int(254))
BEGIN
if(p_mode='Insert')
then
insert  into  tblcurrency
(n_CountryId,t_CurrencyName,d_CreatedOn,n_CreatedBy,b_IsActive,n_BusinessId,n_AdminType)values
(p_countryId,p_currencyName,now(),p_createdBy,p_active,p_businessId,p_admin);
end if;
if(p_mode='Update')
then
update tblcurrency set 
t_CurrencyName=p_currencyName,
n_CountryId=p_countryId,
d_ModifiedOn=now(),
n_ModifiedBy=p_createdBy,
n_AdminType=p_admin where a_CurrencyId=p_id and n_BusinessId=p_businessId;
end if;
if(p_mode='Delete')
then
Delete from tblcurrency where a_CurrencyId=p_id and n_AdminType=p_admin;
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_Addcustomtagtulti
DELIMITER //
CREATE  PROCEDURE `proc_Addcustomtagtulti`(IN `p_mode` varchar(20), IN `p_DeptId` bigint, IN `p_XmlData_tag_gl` longtext, IN `p_AdminType` int, IN `p_BusinessId` int, IN `p_CreatedBy` int )
BEGIN
declare xml_testing longtext;
if(p_mode='Insert')
then
set xml_testing= p_XmlData_tag_gl;
select xml_testing;
call proc_XmlInsert('tblcustomtag',
 xml_testing,
 't_CustText,
  t_CustValue,
  d_CreatedOn,
  n_CreatedBy,
  b_Deleted,
  n_AdminType,         
  n_BusinessId'
  ,concat(now(),',',p_CreatedBy,',',false,
  ',',p_AdminType,
  ',',p_BusinessId)); 
end if;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_AddDepartment
DELIMITER //
CREATE  PROCEDURE `proc_AddDepartment`(IN `p_mode` varchar(20), IN `p_DeptId` bigint, IN `p_DeptName` varchar(80), IN `p_AdminType` int, IN `p_BusinessId` int, IN `p_CreatedBy` int )
BEGIN
if(p_mode='Insert')
then
insert  into  tbldepartment
(
t_DeptName,
d_CreatedOn,
n_CreatedBy,
n_BusinessId,
n_AdminType,
b_Deleted
)
values
(
p_DeptName,
now(),
p_CreatedBy,
p_BusinessId,
p_AdminType,
0
);
end if;
if(p_mode='Update')
then
update tbldepartment set 
t_DeptName=p_DeptName,
d_ModifiedOn=now(),
n_ModifiedBy=p_CreatedBy,
n_AdminType=p_AdminType where a_DeptId=p_DeptId and n_BusinessId=p_BusinessId;
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_AddDepartmentmulty
DELIMITER //
CREATE  PROCEDURE `proc_AddDepartmentmulty`(IN `p_mode` varchar(20), IN `p_DeptId` bigint, IN `p_DeptName` longtext, IN `p_AdminType` int, IN `p_BusinessId` int, IN `p_CreatedBy` int )
BEGIN
declare xml_testing longtext;
if(p_mode='Insert')
then
set xml_testing= p_DeptName;
select xml_testing;
call proc_XmlInsert('tbldepartment',
 xml_testing,
 't_DeptName,
  d_CreatedOn,
  n_CreatedBy,
  b_Deleted,
  n_AdminType,         
  n_BusinessId'
  ,concat(now(),',',p_CreatedBy,',',false,
  ',',p_AdminType,
  ',',p_BusinessId)); 
end if;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_AddEmployeeData
DELIMITER //
CREATE  PROCEDURE `proc_AddEmployeeData`(
IN `p_mode` varchar(20), 
IN `p_EmpId` bigint(100), 
IN `p_IsAdmin` bit, 
IN `p_EmpCode` varchar(80), 
IN `p_Empfname` varchar(80), 
IN `p_EmpLastName` varchar(80), 
IN `p_Email` VARCHAR(255), 
IN `p_Pass` VARCHAR(80), 
IN `p_DeptId` int, 
IN `p_PolicyId` int, 
IN `p_EmpDob` datetime, 
IN `p_OfficePhno` varchar(20), 
IN `p_MobileNo` varchar(15), 
IN `p_AddFLine` varchar(150), 
IN `p_AddSecLine` varchar(150), 
IN `p_AddThrdLine` varchar(150), 
IN `p_Country` int, 
IN `p_State` int , 
IN `p_City` int, 
IN `p_PinCode` int, 
IN `p_Status` bit, 
IN `p_CreatedBy` int, 
IN `p_BusinessId` int,
IN `p_AdminType` int 
)
BEGIN
if(p_mode='Insert')
then
insert into tblemployeemaster
(
is_Admin,t_EmpCode,t_EmpFirstName,t_EmpLastName,n_DeptId,n_policyId,t_EmaiId,
t_Password,t_OfficePhone,t_MobilePhone,d_EmpDOB,t_AddfLine,t_AddSecLine,t_AddThirdLine,
n_CountryId,n_StateId,n_CityId,n_PinCode,n_Status,d_CreatedOn,n_CreatedBy,n_BusinessId,
b_Deleted,n_AdminType
)
values
(
p_IsAdmin,p_EmpCode ,p_Empfname ,p_EmpLastName ,p_DeptId ,p_PolicyId,p_Email,
p_Pass,p_OfficePhno ,p_MobileNo ,p_EmpDob ,p_AddFLine ,p_AddSecLine ,p_AddThrdLine ,
p_Country ,p_State  ,p_City ,p_PinCode ,p_Status ,now(),p_CreatedBy,p_BusinessId,
0,p_AdminType
);
end if;
if(p_mode='Update')
then

update tblemployeemaster set 
is_Admin=p_IsAdmin,
t_EmpCode=p_EmpCode,
t_EmpFirstName=p_Empfname,
t_EmpLastName=p_EmpLastName,
n_DeptId=p_DeptId,
n_policyId=p_PolicyId,
t_OfficePhone=p_OfficePhno,
t_MobilePhone=p_MobileNo,
d_EmpDOB=p_EmpDob,
t_AddfLine=p_AddFLine,
t_AddSecLine=p_AddSecLine,
t_AddThirdLine=p_AddThrdLine,
n_CountryId=p_Country,
n_StateId=p_State,
n_CityId=p_City,
n_PinCode=p_PinCode,
n_Status=p_Status,
d_ModifiedOn=now(),
n_ModifiedBy=p_CreatedBy
where a_EmpId=p_EmpId and n_BusinessId=p_BusinessId;
 
end if;
if(p_mode='deactivate')
then
SET sql_safe_updates=0;
update tblemployeemaster
set n_Status=0 where a_EmpId=p_EmpId and n_BusinessId=p_BusinessId;
end if;
if(p_mode='activate')
then
SET sql_safe_updates=0;
update tblemployeemaster
set n_Status=1 where a_EmpId=p_EmpId and n_BusinessId=p_BusinessId;
end if;

if(p_mode='Delete')
then 
update tblemployeemaster set b_Deleted=1 where a_EmpId=p_EmpId;
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_AddEmployeeData1
DELIMITER //
CREATE  PROCEDURE `proc_AddEmployeeData1`(

 IN `p_EmpId` bigint(100),
 IN `p_Empfname` varchar(80),
 IN `p_EmpLastName` varchar(80),
 IN `p_DeptId` int,
 IN `p_EmpCode` varchar(80),
 IN `p_PolicyId` int, 
IN `p_EmpDob` datetime,
 IN `p_OfficePhno` varchar(20), 
IN `p_MobileNo` varchar(15),
 IN `p_AddFLine` varchar(150),
 IN `p_AddSecLine` varchar(150),
 IN `p_AddThrdLine` varchar(150),
 IN `p_Country` int,
 IN `p_State` int ,
 IN `p_City` int,
 IN `p_PinCode` int,
 IN `p_Status` bit,
 IN `p_CreatedBy` int,
 IN `p_BusinessId` int,
 IN `p_XmlData` varchar(500), 
IN `p_AmountRange`
 decimal(15,3),
 IN `p_CompareValue` varchar(20))
BEGIN

insert into tblemployeemaster
(
t_EmpCode,
t_EmpFirstName,
t_EmpLastName,
n_DeptId,
n_PolicyId,
t_OfficePhone,
t_MobilePhone,
d_EmpDOB,
t_AddfLine,
t_AddSecLine,
t_AddThirdLine,
n_CountryId,
n_StateId,
n_CityId,
n_PinCode,
n_Status,
d_CreatedOn,
n_CreatedBy,
n_BusinessId,
b_Deleted
)
values
(
p_EmpCode ,
p_Empfname ,
p_EmpLastName ,
p_DeptId ,
p_PolicyId ,
p_OfficePhno ,
p_MobileNo ,
p_EmpDob ,
p_AddFLine ,
p_AddSecLine ,
p_AddThrdLine ,
p_Country ,
p_State  ,
p_City ,
p_PinCode ,
p_Status ,
now(),
p_CreatedBy,
p_BusinessId,
0
);
set @n_SIID=Last_INSERT_ID();
-- call proc_XmlInsert('tblDocProMap',p_t_ProductData,'t_ContainerSize,t_ContainerNo ,n_ProductId,n_BrandId, n_NetWt, n_Grosswt, n_UnitPrice,n_ProTotalAmt,n_DocTypeID,n_DocID,n_ExpLcId, n_ExpPiId,n_CreatedBy, d_CreatedOn,n_HostId,n_PaymentId',concat(p_n_DocTypeID,',',@n_BolID,',',p_n_ExpLcId,',',p_n_ExpPiId,',',p_n_CreatedBy,',',now(),',',p_n_HostId,',',p_a_PaymentId));                               
-- set @staticV = concat(@n_SIID,',',p_AmountRange,',',p_CompareValue,',',p_BusinessId,',',p_CreatedBy,',',now());
 call proc_XmlInsert('tblempaccessmap',p_XmlData,'n_RoleAccessId,n_EmpId,n_AmtRange,t_CompareValue,n_BusinessId,n_CreatedBy,d_CreatedOn,',concat(@n_SIID,',',p_AmountRange,',',p_CompareValue,',',p_BusinessId,',',p_CreatedBy,',',now()));                               

END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_AddEmployeeMapData
DELIMITER //
CREATE  PROCEDURE `proc_AddEmployeeMapData`(
IN `p_mode` varchar(20), 
IN `p_EmpAccessMapId` int(100),
IN `p_RoleAccess` int,
IN `p_EmpId` bigint,
IN `p_AmountRange` decimal(15,3), 
IN `p_CompareValue` varchar(10),
IN `p_CreatedBy` int, 
IN `p_BusinessId` int 
)
BEGIN
if(p_mode='InsertMapping')
then
insert into tblempaccessmap
(n_RoleAccessId,n_EmpId,n_AmtRange,t_CompareValue,n_BusinessId,n_CreatedBy,d_CreatedOn
)
values(p_RoleAccess,p_EmpId,p_AmountRange,p_CompareValue,p_BusinessId,p_CreatedBy,now());
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_AddEmployeeRoleData
DELIMITER //
CREATE  PROCEDURE `proc_AddEmployeeRoleData`(
IN `p_mode` varchar(20), IN `p_EmpAccessMapId` int,
IN `p_RoleAccessId` int, IN `p_EmpId` bigint,
IN `p_AmtRange` DECIMAL(15,3),IN `p_CompareValue` varchar(10),
IN `p_CreatedBy` bigint,`p_BusinessId` int
)
BEGIN
if(p_mode='Insert')
then
insert into tblempaccessmap
(n_RoleAccessId,n_EmpId,n_AmtRange,t_CompareValue,d_CreatedOn,n_CreatedBy,
b_Deleted,n_BusinessId)
values
(p_RoleAccessId ,p_EmpId ,p_AmtRange ,p_CompareValue ,now(),p_CreatedBy,0,p_BusinessId);
end if;

END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_Addspndngcatmulti
DELIMITER //
CREATE  PROCEDURE `proc_Addspndngcatmulti`(IN `p_mode` varchar(20), IN `p_DeptId` bigint, IN `p_XmlData_sp_gl` longtext, IN `p_AdminType` int, IN `p_BusinessId` int, IN `p_CreatedBy` int )
BEGIN
declare xml_testing longtext;
if(p_mode='Insert')
then
set xml_testing= p_XmlData_sp_gl;
select xml_testing;
call proc_XmlInsert('tblspndngcat',
 xml_testing,
 't_SpndName,
  t_GLCode,
  d_CreatedOn,
  n_CreatedBy,
  b_Deleted,
  n_AdminType,         
  n_BusinessId'
  ,concat(now(),',',p_CreatedBy,',',false,
  ',',p_AdminType,
  ',',p_BusinessId)); 
end if;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_AddState
DELIMITER //
CREATE  PROCEDURE `proc_AddState`(IN `p_mode` varchar(20), IN `p_CountryId` bigint, IN `p_StateId` bigint, IN `p_StateName` varchar(80), IN `p_AdminType` int, IN `p_BusinessId` int, IN `p_CreatedBy` int , IN `active` ENUM('1','0'))
BEGIN
if(p_mode='Insert')
then
insert  into  tblstate
(t_StateName,n_CountryId,d_CreatedOn,n_CreatedBy,n_BusinessId,n_AdminType,d_ModifiedOn,n_ModifiedBy,b_IsActive)values
(p_StateName,p_CountryId,now(),p_CreatedBy,p_BusinessId,p_AdminType,now(),0,active);
end if;
if(p_mode='Update')
then
update tblstate set 
t_StateName=p_StateName,
n_CountryId=p_CountryId,
d_ModifiedOn=now(),
n_ModifiedBy=p_CreatedBy,
n_AdminType=p_AdminType where a_StateId=p_StateId and n_BusinessId=p_BusinessId;
end if;
if(p_mode='Delete')
then
Delete from tblstate where a_StateId=p_StateId and n_AdminType=p_AdminType;
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_adminLogin
DELIMITER //
CREATE  PROCEDURE `proc_adminLogin`(IN `firstName` VARCHAR(50), IN `lastName` VARCHAR(50), IN `email` varchar(255), IN `myPassword` varchar(255), IN `createdby` INT, IN `act_mode` varchar (255), IN `n_CountryId_1` INT, IN `n_StateId_1` INT, IN `t_Address1` VARCHAR(255), IN `userId` INT)
BEGIN

	if(`act_mode` = 'SuperAdmin')
	
	then 
		
	select * from `tbl_systemlogin` where `t_username` = email and `t_password` = myPassword and `IsActive` ='Active'; 
   
	end if;
	
	
	if(`act_mode` = 'lastLogin')
	
	then
		update `tbl_systemlogin` set `d_modifiedon` = NOW() where a_SysloginId= userId;

	end if;
	
	if(`act_mode`= 'insertSelect')
	
	then
		insert into tbl_systemlogin (`firstName`,`lastName`,`a_SysAdminId`,`n_CityId` , `n_StateId` , `t_Address` ,`t_username`,`t_password`,`n_createdby`,`d_createdon`) values (firstName,lastName,33,n_CountryId_1, n_StateId_1, t_Address1, email, myPassword,createdby,NOW());

	end if;
	
	if(`act_mode`= 'selectall')
	then
		select * from `tbl_systemlogin` where IsActive != 'Delete';
	end if;

	if(`act_mode`= 'displaysingle')
	then
		select * from `tbl_systemlogin` where IsActive != 'Delete'  and a_SysloginId = userId;
	end if;
	
	if(`act_mode`='lastlogin')
	then
	   update tbl_systemlogin SET `lastlogin`=NOW() where a_SysloginId=userId ;
	   
	end if;   
	


	
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_bmenu
DELIMITER //
CREATE  PROCEDURE `proc_bmenu`(IN `m_type` INT)
BEGIN
SELECT * FROM tbl_menu WHERE n_ParentId=m_type;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_busadminpro
DELIMITER //
CREATE  PROCEDURE `proc_busadminpro`(IN `bid` INT, IN `bdob` DATETIME, IN `bphone` VARCHAR(100), IN `bmobile` VARCHAR(100), IN `baddress` VARCHAR(255), IN `bcity` INT, IN `bstate` INT, IN `bcountry` INT, IN `bpin` VARCHAR(50), IN `bseq` VARCHAR(255), IN `act_mode` VARCHAR(255))
begin

IF(`act_mode`='view')THEN
select* from tbl_businessadmin where a_BusnAdminId= bid and b_Deleted !='1';
END IF;

IF(`act_mode`='pupdate') THEN
UPDATE tbl_businessadmin SET
d_DOB = bdob,
t_Contact= bphone,
t_Mobile = bmobile,
tba_Address = baddress,
n_CountryId =bcountry,
n_StateId = bstate,
n_CityId = bcity,
t_Pincode = bpin,
n_seqcode = bseq,
d_ModifiedOn = NOW()

WHERE a_BusnAdminId = bid;

END IF;

end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_businessadd
DELIMITER //
CREATE  PROCEDURE `proc_businessadd`(IN `p_mode` varchar(20), IN `p_BusinessId` bigint, IN `p_Busineescode` varchar(80), IN `p_BussinessName` varchar(80), IN `p_Countryid` int, IN `p_StateId` int, IN `p_CityId` int, IN `p_Address` varchar(150), IN `p_Status` int , IN `p_Startdate` datetime, IN `p_EndDate` datetime, IN `p_UserCount` int , IN `p_CurrencyId` int, IN `p_ExpInOtrCurrency` bit, IN `p_Dateformat` varchar(50), IN `p_AdminId` int, IN `p_BillingType` int, IN `p_BillingName` varchar(100), IN `p_BillingEame` VARCHAR(50), IN `p_BillingAddr` varchar(150), IN `p_Package` int, IN `p_Distance` int, IN `p_Fname` varchar(80), IN `p_Lname` varchar(80), IN `p_ConidfAppInf` int, IN `p_StateIdfAppInf` int, IN `p_CityIdfAppInf` int, IN `p_AddrfAppInf` varchar(150) , IN `p_ContactfAppIn` varchar(20), IN `p_EmailfAppIn` varchar(30), IN `p_DobfAppIn` datetime, IN `p_PositionfAppIn` int, IN `p_AdminTypefAppIn` int , IN `p_CreatedOn` datetime, IN `p_CreatedBy` int , IN `p_Deleted` int)
BEGIN

declare a_BusinessId bigint;

     
if(p_mode='Insert')

then

insert into tblbusiness

(

t_BusinessCode,

t_BusinessName,

n_countryId,

n_StateId,

n_City,

t_Address,

n_Status,

d_StartDate,

d_EndDate,

n_UserCount,

n_CurrencyId,

b_ExpOtherCtry,

t_DateFormat,

n_AdminId,

n_BillingType,

t_Billingname,

t_BillingEmailAdd,

n_Package,

n_Distance,

d_CreatedOn,

n_CreatedBy,

b_Deleted

)

values

(

p_Busineescode ,

p_BussinessName ,

p_Countryid ,

p_StateId ,

p_CityId ,

p_Address ,

p_Status  ,

p_Startdate ,

p_EndDate ,

p_UserCount  ,

p_CurrencyId ,

p_ExpInOtrCurrency ,

p_Dateformat,

p_AdminId ,

p_BillingType ,

p_BillingName,

p_BillingEame ,

p_Package ,

p_Distance ,

now(),

p_CreatedBy,

0);

select a_BusinessId;

SET a_BusinessId=LAST_INSERT_ID(); 

-- select a_BusinessId;

insert into tbl_businessadmin

(

t_AdminCode,

t_FirstName,

t_LastName,

n_CountyId,

n_CityId,

n_StateId,

t_Address,

t_Contact,

t_Email,

d_DOB,

n_Positon,

n_AdminType,

d_CreatedOn,

n_CreatedBy,

b_Deleted,

n_BusinessId

)

values

(

'test',

p_Fname ,

p_Lname ,

p_ConidfAppInf ,

p_StateIdfAppInf ,

p_CityIdfAppInf ,

p_AddrfAppInf  ,

p_ContactfAppIn ,

p_EmailfAppIn ,

p_DobfAppIn ,

p_PositionfAppIn ,

p_AdminTypefAppIn  ,

now(),

p_CreatedBy,

0 ,

a_BusinessId

);

end if;


END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_BusinessAdminEditOrView
DELIMITER //
CREATE  PROCEDURE `proc_BusinessAdminEditOrView`(
IN `p_mode` varchar(20), 
IN `p_BusnAdminId` int,
IN `p_Username` varchar(50),
IN `p_Password` varchar(50), 
IN `p_FirstName` varchar(50), 
IN `p_BusinessId` int
)
BEGIN
if(p_mode='login')
then
select * from tbl_businessadmin where t_Email=p_Username and t_password=p_Password;
end if;
if(p_mode='EditOrView')
then 
select * from tbl_businessadmin where a_BusnAdminId=p_BusnAdminId and  b_Deleted=0 and b_Status=1 and n_BusinessId=p_BusinessId;
end if;
if(p_mode='SelectList')
then 
select a_BusnAdminId,t_FirstName, t_LastName from tbl_businessadmin where b_Status=1 and b_Deleted=0 and n_BusinessId=p_BusinessId ;
end if;
if(p_mode='Delete')
then 
update tbl_businessadmin set b_Deleted=1 where a_BusnAdminId=p_BusnAdminId;
end if;
if(p_mode='SelectEdit')
then 
select tbl_businessadmin.*,tblempaccessmap.n_RoleAccessId,tblempaccessmap.a_EmpAccessMapId,tblempaccessmap.n_AmtRange
from tbl_businessadmin
left join tblempaccessmap on tbl_businessadmin.a_BusnAdminId=tblempaccessmap.n_EmpId
where tbl_businessadmin.a_BusnAdminId=p_BusnAdminId and tbl_businessadmin.b_Deleted=0 and tblempaccessmap.n_BusinessId=p_BusinessId;


end if;

if(p_mode='SelectEmpEdit')
then 
select * from tbl_businessadmin
where a_BusnAdminId=p_BusnAdminId and b_Deleted=0;
end if;

if(p_mode='SearchSelect')
then
select * from tbl_businessadmin where b_Deleted=0 and n_BusinessId=p_BusinessId and b_Status=1 and (t_FirstName LIKE CONCAT('%',p_FirstName,'%') or t_LastName LIKE CONCAT('%',p_FirstName,'%'));
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_businessdeleted
DELIMITER //
CREATE  PROCEDURE `proc_businessdeleted`(IN `p_mode` varchar(20), IN `p_BusinessId` bigint, IN `deleted` INT)
BEGIN
if(p_mode='delete')
then
update tblbusiness set 
d_ModifiedOn=now(),
b_Deleted=deleted
where a_BusinessId=p_BusinessId;
select p_BusinessId;
update tbl_businessadmin set
b_Deleted=deleted
where n_BusinessId=p_BusinessId;
end if;

END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_Businessdtl
DELIMITER //
CREATE  PROCEDURE `proc_Businessdtl`(IN `p_mode` varchar(20), IN `p_BusinessId` bigint, IN `p_Busineescode` varchar(80), IN `p_BussinessName` varchar(80), IN `p_Countryid` int, IN `p_StateId` int, IN `p_CityId` int, IN `p_Address` varchar(150), IN `p_Status` int , IN `p_Startdate` datetime, IN `p_EndDate` datetime, IN `p_UserCount` int , IN `p_CurrencyId` varchar(50), IN `p_ExpInOtrCurrency` bit, IN `p_Dateformat` varchar(50), IN `p_AdminId` int, IN `p_BillingType` int, IN `p_BillingName` varchar(100), IN `p_BillingAddr` varchar(150), IN `p_BillingAddrline1` varchar(100), IN `p_BillingAddrline2` varchar(100), IN `bill_contry` int, IN `bill_state` int, IN `bill_city` int, IN `p_Package` int, IN `p_Distance` int, IN `p_Fname` varchar(80), IN `p_Lname` varchar(80), IN `p_ConidfAppInf` int, IN `p_StateIdfAppInf` int, IN `p_CityIdfAppInf` int, IN `p_AddrfAppInf` varchar(150) , IN `p_ContactfAppIn` varchar(20), IN `p_EmailfAppIn` varchar(30), IN `p_PassAppIn` VARCHAR(200), IN `p_DobfAppIn` datetime, IN `p_PositionfAppIn` VARCHAR(100), IN `p_AdminTypefAppIn` INT, IN `p_CreatedOn` datetime, IN `p_CreatedBy` int , IN `p_Deleted` int)
BEGIN
declare a_BusinessId bigint;

if(p_mode='Insert')
then
insert into tblbusiness
(
t_BusinessCode,
t_BusinessName,
n_CountryId,
n_StateId,
n_City,
t_Address,
n_Status,
d_StartDate,
d_EndDate,
n_UserCount,
n_CurrencyId,
b_ExpOtherCtry,
t_DateFormat,
n_AdminId,
n_BillingType,
t_Billingname,
t_BillingEmailAdd,
n_Package,
n_Distance,
d_CreatedOn,
n_CreatedBy,
b_Deleted,
bill_cont_id,
bill_state_id,
bill_city_id,
t_AddfLine,
t_AddSecLine,
bill_contact

)
values
(
p_Busineescode ,
p_BussinessName ,
p_Countryid ,
p_StateId ,
p_CityId ,
p_Address ,
p_Status  ,
p_Startdate ,
p_EndDate ,
p_UserCount  ,
p_CurrencyId ,
p_ExpInOtrCurrency ,
p_Dateformat,
p_AdminId ,
p_BillingType ,
p_BillingName,
p_BillingAddr ,
p_Package ,
p_Distance ,
now(),
p_CreatedBy,
0,
bill_contry,
bill_state,
bill_city,
p_BillingAddrline1,
p_BillingAddrline2,
p_ContactfAppIn

);
-- select a_BusinessId;
SET a_BusinessId=LAST_INSERT_ID(); 
-- select a_BusinessId;
insert into tbl_businessadmin
(
t_AdminCode,
t_FirstName,
t_LastName,
n_CountryId,
n_CityId,
n_StateId,
tba_Address,
t_Contact,
t_Email,
t_password,
d_DOB,
n_Positon,
n_AdminType,
d_CreatedOn,
n_CreatedBy,
b_Deleted,
n_BusinessId,
b_Status
)
values
(
'test',
p_Fname ,
p_Lname ,
p_ConidfAppInf ,
p_CityIdfAppInf ,
p_StateIdfAppInf ,
p_AddrfAppInf  ,
p_ContactfAppIn ,
p_EmailfAppIn ,
p_PassAppIn ,
p_DobfAppIn ,
p_PositionfAppIn ,
p_AdminTypefAppIn  ,
now(),
p_CreatedBy,
0 ,
a_BusinessId,
1
);
select last_insert_id() as lastid;

end if;

if(p_mode='Update')
then
SET SQL_SAFE_UPDATES=0;
update tblbusiness set 
t_BusinessName=p_BussinessName,
n_countryId=p_Countryid,
n_StateId=p_StateId ,
n_City=p_CityId,
t_Address=p_Address,
n_Status=p_Status,
d_StartDate=p_Startdate,
d_EndDate=p_EndDate,
n_UserCount=p_UserCount,
n_CurrencyId=p_CurrencyId,
b_ExpOtherCtry=p_ExpInOtrCurrency,
t_DateFormat=p_Dateformat,
n_AdminId=p_AdminId,
n_BillingType=p_BillingType,
t_Billingname=p_BillingName,
t_BillingEmailAdd=p_BillingAddr,
n_Package=p_Package,
n_Distance=p_Distance,
d_ModifiedOn=now(),
n_ModifiedBy=p_CreatedBy,
bill_cont_id=bill_contry ,
bill_state_id= bill_state ,
bill_city_id=bill_city ,
t_AddfLine= p_BillingAddrline1 ,
t_AddSecLine= p_BillingAddrline1
where a_BusinessId=p_BusinessId and  b_Deleted=0;
update tbl_businessadmin set
t_AdminCode=p_Busineescode,
t_FirstName=p_Fname,
t_LastName=p_Lname,
n_CountyId=p_ConidfAppInf,
n_CityId=p_CityIdfAppInf,
n_StateId=p_StateIdfAppInf,
tba_Address=p_AddrfAppInf,
t_Contact=p_ContactfAppIn,
t_Email=p_EmailfAppIn,
d_DOB=p_DobfAppIn,
n_Positon=p_PositionfAppIn,
n_AdminType=p_AdminTypefAppIn,
-- d_CreatedOn= now(),
n_CreatedBy=p_CreatedBy
where n_BusinessId=p_BusinessId  and  b_Deleted=0;
end if;

END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_BusinessdtlList
DELIMITER //
CREATE  PROCEDURE `proc_BusinessdtlList`(
p_startRowIndex int,                                                                            
p_maximumRows int,
p_BusinessCode varchar(100),
p_BusinnessName varchar(100)
)
BEGIN
SET p_startRowIndex =  (p_startRowIndex - 1)  * p_maximumRows  + 1;
IF (p_startRowIndex = 0)
then
SET p_startRowIndex = 1;  
end if;
SET @rank=0;      
DROP TEMPORARY TABLE IF EXISTS tt;                    
CREATE TEMPORARY TABLE IF NOT EXISTS tt AS
(
select @rank:=@rank+1 as SN,t1.* from (select t_BusinessCode,t_BusinessName,t_Address,DATE_FORMAT(d_StartDate,'%d-%b-%y'),DATE_FORMAT(d_EndDate,'%d-%b-%y'),t_Billingname,t_BillingAdd
from tblbusiness where b_Deleted=0 
and (t_BusinessCode=p_BusinessCode or p_BusinessCode is null)
and  (t_BusinessName=p_BusinnessName or p_BusinnessName is null)
order by a_BusinessId desc) as t1
);
select * from tt  where SN BETWEEN p_startRowIndex AND (p_startRowIndex + p_maximumRows) - 1;                        
select COUNT(SN) from tt ;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_businessedit
DELIMITER //
CREATE  PROCEDURE `proc_businessedit`(IN `p_mode` varchar(20), IN `id` INT, IN `businessname` vARCHAR(50), IN `bu_status` INT(10), IN `bus_StateId_1` INT, IN `bus_City_1` int, IN `bus_Address` VARCHAR(50), IN `bus_UserCount` int, IN `bus_StartDate` VARCHAR(50), IN `bus_EndtDate` varchar(150), IN `bus_Currency` VARCHAR(50), IN `bus_ExpOtherCtry` VARCHAR(50), IN `bus_DateFormat` VARCHAR(50), IN `bus_Distance` VARCHAR(50), IN `appFName` VARCHAR(50), IN `appLName` VARCHAR(50), IN `applicant_address` varchar(100), IN `app_CountryId_2` int, IN `app_StateId_2` int, IN `app_City_2` varchar(100), IN `appPhone` VARCHAR(50), IN `appEmail` varchar(150), IN `appDob` int, IN `appCompanyPo` int, IN `BillingType` varchar(80), IN `billContact` varchar(80), IN `BillingEmail` int, IN `BillingPackage` int, IN `BullingAddress` int, IN `BillingAddress2` varchar(150) , IN `bill_CountryId` varchar(20), IN `bill_StateId` varchar(30), IN `bill_City` datetime)
begin 

if(`act_mode`='update') then

update tblbusiness set 

t_BusinessName=businessname,
n_countryId=bus_City_1,
n_StateId=bus_StateId_1 ,
n_City=bus_City_1,
t_Address=bus_Address,
n_Status=bu_status,
d_StartDate=bus_StartDate,
d_EndDate=bus_EndtDate,
n_UserCount=p_UserCount,
n_CurrencyId=bus_Currency,
b_ExpOtherCtry=bus_ExpOtherCtry,
t_DateFormat=bus_DateFormat,

n_BillingType=BillingType,
t_Billingname=billContact,
t_BillingEmailAdd=BillingEmail,
n_Package=BillingPackage,
n_Distance=bus_Distance,
d_ModifiedOn=now(),
n_ModifiedBy=p_CreatedBy
where a_BusinessId=id;
update tbl_businessadmin set
t_AdminCode=p_Busineescode,
t_FirstName=appFName,
t_LastName=appLName,
n_CountyId=app_CountryId_2,
n_CityId=app_City_2,
n_StateId=app_StateId_2,
t_Address=applicant_address,
t_Contact=appPhone,
t_Email=appEmail,
d_DOB=appDob,
n_Positon=appCompanyPo,

d_CreatedOn=now(),
n_CreatedBy=p_CreatedBy
where n_BusinessId=id;
	
end if;

END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_BusinessEditOrView
DELIMITER //
CREATE  PROCEDURE `proc_BusinessEditOrView`(
p_mode varchar(20),
p_BusinessId bigint
)
BEGIN
if(p_mode='EditOrView')
then
select 
t_BusinessCode,
t_BusinessName,
n_countryId,
n_StateId,
n_City,
t_Address,
n_Status,
d_StartDate,
d_EndDate,
n_UserCount,
n_CurrencyId,
b_ExpOtherCtry,
t_DateFormat,
n_AdminId,
n_BillingType,
t_Billingname,
t_BillingAdd,
n_Package,
n_Distance
from tblbusiness where  a_BusinessId=p_BusinessId and b_Deleted=0;
select 
t_AdminCode,
t_FirstName,
t_LastName,
n_CountyId,
n_CityId,
n_StateId,
t_Address,
t_Contact,
t_Email,
d_DOB,
n_Positon,
n_AdminType
from  tbl_businessadmin where n_BusinessId =p_BusinessId and b_Deleted=0;
end if;
if(p_mode='Delete')
then
SET SQL_SAFE_UPDATES=0;
update tblbusiness set b_Deleted=1 where a_BusinessId=p_BusinessId;
update tbl_businessadmin set b_Deleted=1 where p_BusinessId=p_BusinessId;
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_businesslist
DELIMITER //
CREATE  PROCEDURE `proc_businesslist`(IN `id` INT(5), IN `bdeleted` INT(5), IN `act_mode` VARCHAR(50))
BEGIN
if(`act_mode`='allview') then
select * from tblbusiness where `b_Deleted` !=1 ORDER BY a_BusinessId DESC; 
end if;
if(`act_mode`='view')then 
select* from   tblbusiness tb inner join  tbl_businessadmin tba on tb.a_BusinessId = tba.n_BusinessId where tb.a_BusinessId=id; 
end if;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_BusinessPnlView
DELIMITER //
CREATE  PROCEDURE `proc_BusinessPnlView`(

)
BEGIN
select 
TB.t_AddfLine,
TB.t_AddsecLine,
TB.n_countryId,
TB.n_StateId,
TB.n_City,
TBA.t_FirstName,
TBA.t_LastName, 
TBA.t_Email from tblbusiness TB inner join tbl_businessadmin TBA 
on TB.a_BusinessId=TBA.n_BusinessId where   TB.b_Deleted=0 and  TBA.b_Deleted=0;
select count(a_PolicyId) from tblpolicymaster where b_Deleted=0;
select count(a_empid) from tblemployeemaster where b_Deleted=0;
select count(a_businessId) from tblbusiness where b_Deleted=0;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_businesssearch
DELIMITER //
CREATE  PROCEDURE `proc_businesssearch`(IN `b_search` varchar(200), IN `act_mode` VARCHAR(50))
begin
if(act_mode='by_name')then 
select t_BusinessName ,a_BusinessId  from tblbusiness
where `t_BusinessName` LIKE CONCAT(b_search,'%');
end if;
if(act_mode='by_status')then
select t_BusinessName ,a_BusinessId  from tblbusiness
where `n_Status` LIKE CONCAT('%',b_search,'%');
end if;
if(act_mode='by_bulling')then
select t_BusinessName ,a_BusinessId  from tblbusiness
where `n_BillingType` LIKE CONCAT('%',b_search,'%');
end if;
if(act_mode='all') then
select a_BusinessId , t_BusinessName  from tblbusiness where b_Deleted =0;
end if;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_business_bdtl
DELIMITER //
CREATE  PROCEDURE `proc_business_bdtl`(IN `id` int(10))
begin 
select* from  tbl_businessadmin tba  right join tblbusiness tb on tba.n_BusinessId =tb.a_BusinessId 
where tba.a_BusnAdminId=id and tba.b_Deleted='0' and tb.b_Deleted='0';
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_business_login
DELIMITER //
CREATE  PROCEDURE `proc_business_login`(
IN `p_myemail` varchar(255), 
IN `p_mypassword` varchar(255), 
IN `p_actmode` varchar(20),
IN `p_userId` bigint, 
IN `p_BusinessId` int
)
begin
if(p_actmode='BusinessAdmin')
then
select *
from `tbl_businessadmin` 
where t_Email = p_myemail and t_password = p_mypassword and b_Deleted = 0;
end if;
if(p_actmode='role')
then
select n_RoleAccessId from tblempaccessmap 
where n_EmpId=p_userId and n_BusinessId=p_BusinessId;
end if;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_bus_upd
DELIMITER //
CREATE  PROCEDURE `proc_bus_upd`(IN `p_mode` varchar(20), IN `p_BusinessId` bigint, IN `p_Busineescode` varchar(80), IN `p_BussinessName` varchar(80), IN `p_Countryid` int, IN `p_StateId` int, IN `p_CityId` int, IN `p_Address` varchar(150), IN `p_Status` int , IN `p_Startdate` datetime, IN `p_EndDate` datetime, IN `p_UserCount` int , IN `p_CurrencyId` varchar(50), IN `p_ExpInOtrCurrency` int, IN `p_Dateformat` varchar(50), IN `p_AdminId` int, IN `p_BillingType` int, IN `p_BillingName` varchar(100), IN `p_BillingAddr` varchar(150), IN `p_BillingAddrline1` VARCHAR(100), IN `p_BillingAddrline2` VARCHAR(100), IN `p_BillContact` BIGINT, IN `bill_contry` INT, IN `bill_state` INT, IN `bill_city` INT, IN `p_Package` int, IN `p_Distance` int, IN `p_Fname` varchar(80), IN `p_Lname` varchar(80), IN `p_ConidfAppInf` int, IN `p_StateIdfAppInf` int, IN `p_CityIdfAppInf` int, IN `p_AddrfAppInf` varchar(150) , IN `p_ContactfAppIn` varchar(20), IN `p_EmailfAppIn` varchar(30), IN `p_DobfAppIn` datetime, IN `p_PositionfAppIn` VARCHAR(100), IN `p_AdminTypefAppIn` INT, IN `p_CreatedOn` datetime, IN `p_CreatedBy` int , IN `p_Deleted` int)
BEGIN
if(p_mode='Update')
then
update tblbusiness set 
t_BusinessName=p_BussinessName,
n_countryId=p_Countryid,
n_StateId=p_StateId ,
n_City=p_CityId,
t_Address=p_Address,
n_Status=p_Status,
d_StartDate=p_Startdate,
d_EndDate=p_EndDate,
n_UserCount=p_UserCount,
n_CurrencyId=p_CurrencyId,
b_ExpOtherCtry=p_ExpInOtrCurrency,
t_DateFormat=p_Dateformat,
n_AdminId=p_AdminId,
n_BillingType=p_BillingType,
t_Billingname=p_BillingName,
t_BillingEmailAdd=p_BillingAddr,
n_Package=p_Package,
n_Distance=p_Distance,
d_ModifiedOn=now(),
n_ModifiedBy=p_CreatedBy,
bill_cont_id=bill_contry ,
bill_state_id= bill_state ,
bill_city_id=bill_city ,
t_AddfLine= p_BillingAddrline1 ,
t_AddSecLine= p_BillingAddrline2,
bill_contact = p_BillContact

where a_BusinessId=p_BusinessId  and  b_Deleted=0;

update tbl_businessadmin set
t_AdminCode=p_Busineescode,
t_FirstName=p_Fname,
t_LastName=p_Lname,
n_CountryId=p_ConidfAppInf,
n_CityId=p_CityIdfAppInf,
n_StateId=p_StateIdfAppInf,
tba_Address=p_AddrfAppInf,
t_Contact=p_ContactfAppIn,
t_Email=p_EmailfAppIn,
d_DOB=p_DobfAppIn,
n_Positon=p_PositionfAppIn,
n_AdminType=p_AdminTypefAppIn,
-- d_CreatedOn= now(),
n_CreatedBy=p_CreatedBy
where n_BusinessId=p_BusinessId  and  b_Deleted=0;
end if;

END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_checkbemail
DELIMITER //
CREATE  PROCEDURE `proc_checkbemail`(IN `bemail` VARCHAR (255), IN `bseq` VARCHAR(255), IN `act_mode` VARCHAR(100))
begin
if(`act_mode`='emailcheck')then
select count(*) as correctemail  from `tbl_businessadmin` where t_Email =bemail;
end if;
if(`act_mode`='seqcheck')then
select count(*) as correctseq  from `tbl_businessadmin` where n_seqcode =bseq AND t_Email=bemail;
end if;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_countryManage
DELIMITER //
CREATE  PROCEDURE `proc_countryManage`(
IN `countryName` varchar(255), 
IN `id` int(11), 
IN `act_mode` varchar(255), 
IN `createdBy` VARCHAR(255), 
IN `active` ENUM('1','0'), 
IN `businessId` INT, 
IN `adminUser` INT)
BEGIN
if(`act_mode` = 'select')
then
select * from `tblcountry` where b_IsActive = active AND n_BusinessId=businessId  ;
end if;
if(`act_mode` = 'editselect')
then
	select * from `tblcountry` where b_IsActive =active AND a_CountryId= id;
end if;
if(`act_mode`='insertinto')
then
insert into `tblcountry` (`t_CountryName`, `d_CreatedOn`,`n_CreatedBy`,`b_IsActive`,`n_BusinessId`,`n_AdminType`) values (countryName, NOW(),`createdBy`,`active`,`businessId`,`adminUser`); 
end if;
if(`act_mode`='update')
then
update `tblcountry` set `t_CountryName` = countryName, d_ModifiedOn = NOW() where a_CountryId = id;
end if;
if(`act_mode` = 'delete')
then
delete from `tblcountry` where b_IsActive = 1 AND a_CountryId= id;
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_currencyList
DELIMITER //
CREATE  PROCEDURE `proc_currencyList`(in Active int(11))
begin
	select * from `tblcurrency` where b_IsActive =1 ;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_displayCity
DELIMITER //
CREATE  PROCEDURE `proc_displayCity`(in stateId int(11))
begin
		select * from `tblcity` where n_StateId= stateId; 
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_displaystate
DELIMITER //
CREATE  PROCEDURE `proc_displaystate`(IN `countryId` int(11))
begin
	select * from `tblstate` where n_CountryId = countryId;  
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_EditOrViewRoleAccess
DELIMITER //
CREATE  PROCEDURE `proc_EditOrViewRoleAccess`(IN `p_mode` varchar(20), IN `p_id` INT, IN `p_businessId` int,IN `p_AdminType` int)
BEGIN
if(p_mode='Select')
then 
select * from tblroleaccess where n_BusinessId=p_businessId and n_AdminType=p_AdminType and b_Deleted=0;
end if;

END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_EditOrViewSpndCat
DELIMITER //
CREATE  PROCEDURE `proc_EditOrViewSpndCat`(
p_SpndngCatId bigint,
p_mode varchar(20),
p_BusinessId int
)
BEGIN
if(p_mode='EditOrView')
then
select t_SpndName,t_GLCode from tblspndngcat where a_SpndngCatId=p_SpndngCatId and b_Deleted=0 and n_BusinessId=p_BusinessId;
end if;
if(p_mode='Delete')
then
update tblspndngcat set b_Deleted=1 where a_SpndngCatId=p_SpndngCatId and n_BusinessId=p_BusinessId;
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_EditViewBusinessName
DELIMITER //
CREATE  PROCEDURE `proc_EditViewBusinessName`(IN `p_mode` varchar(25), IN `p_id` int(254))
BEGIN
if(`p_mode` = 'Select')
	
	then
	select * from tblbusiness  where n_Status=1 and b_Deleted=0;
	
	end if;
	
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_EditViewCity
DELIMITER //
CREATE  PROCEDURE `proc_EditViewCity`(
IN `p_mode` int(10), 
IN `p_id` INT, 
IN `p_admin` int(11)
)
BEGIN
if(`p_mode` = 'Editselect')
then
select * from tblcity where a_CityId=p_id and n_AdminType=p_admin;
end if;
if(`p_mode`='select')
then
select t_CountryName,a_CityId,t_StateName,t_CityName
from tblcountry
inner join tblstate on tblcountry.a_CountryId=tblstate.n_CountryId
inner join tblcity on tblstate.a_StateId=tblcity.n_StateId where tblcity.b_Deleted=0 and tblcity.n_AdminType=p_admin;
end if;

END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_EditViewCurrency
DELIMITER //
CREATE  PROCEDURE `proc_EditViewCurrency`(in p_mode varchar(25),p_id int(254),p_active BIT(1),p_businessId int(254),p_admin int(254))
BEGIN
if(`p_mode` = 'Select')
	
	then
	select tblcurrency.*,tblcountry.t_CountryName from tblcurrency LEFT JOIN tblcountry ON tblcurrency.n_CountryId=tblcountry.a_CountryId where tblcurrency.b_IsActive=p_active and tblcurrency.n_AdminType=p_admin;
	
	end if;
	
	if(`p_mode` = 'Editselect')
	
	then
	
	select * from tblcurrency where b_IsActive = p_active AND n_BusinessId=p_businessId and a_CurrencyId= p_id and n_AdminType=p_admin;
	
	end if;
	
if(`p_mode`='Stateselect')
then
	select * from tblstate where b_IsActive = active and n_AdminType=admin and n_BusinessId=p_BusinessId and n_CountryId= id;
	end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.Proc_EditViewDept
DELIMITER //
CREATE  PROCEDURE `Proc_EditViewDept`(
p_mode varchar(20),
p_DeptId bigint,
p_BusinessId int
)
BEGIN
if(p_mode='EditView')
then
select t_DeptName from tbldepartment where a_DeptId=p_DeptId  and b_Deleted=0 and n_BusinessId=p_BusinessId;
end if;
if(p_mode='Delete')
then
update tbldepartment set b_Deleted=1 where a_DeptId=p_DeptId and n_BusinessId=p_BusinessId;
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_EditViewDM
DELIMITER //
CREATE  PROCEDURE `proc_EditViewDM`(IN `p_mode` VARCHAR(50), IN `p_id` INT, IN `p_BusinessId` bigint, IN `p_enumId1` int, IN `p_AdminType` int)
BEGIN
if(`p_mode`='Select')
then
 
select tblsettingvalue.*,tblsettingtype.t_EnumTypeDescription
from tblsettingvalue
LEFT JOIN tblsettingtype ON tblsettingvalue.n_EnumId=tblsettingtype.a_EnumId where tblsettingvalue.b_IsActive=1 and tblsettingvalue.n_EnumId=p_enumId1 and tblsettingvalue.n_AdminType ;
end if;
if(`p_mode`='Editselect')
then

select * from tblsettingvalue where a_SettingId=p_id;
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_EditViewState
DELIMITER //
CREATE  PROCEDURE `proc_EditViewState`(
IN `id` bigint, 
IN `active` ENUM('1','0'), 
IN `p_BusinessId` int, 
IN `p_mode` VARCHAR(255), 
IN `admin` INT)
BEGIN
if(`p_mode` = 'Select')
then
select tblstate.*,tblcountry.t_CountryName from tblstate LEFT JOIN tblcountry ON tblstate.n_CountryId=tblcountry.a_CountryId where tblstate.b_IsActive=active and tblstate.n_AdminType=admin;
end if;
if(`p_mode` = 'Editselect')
then
select * from tblstate where b_IsActive = active AND n_BusinessId=p_BusinessId and a_StateId= id and n_AdminType=admin;
end if;
if(`p_mode`='Stateselect')
then
select * from tblstate where b_IsActive = active and n_CountryId= id;
end if;

END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_empcodecheck
DELIMITER //
CREATE  PROCEDURE `proc_empcodecheck`(IN `e_EmpCode` VARCHAR(255))
BEGIN

SELECT COUNT(*) empcode FROM tblemployeemaster WHERE t_EmpCode=e_EmpCode;

END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_EmpEditOrView
DELIMITER //
CREATE  PROCEDURE `proc_EmpEditOrView`(
IN `p_mode` varchar(20), 
IN `p_BusinessId` int,
IN `p_IsAdmin` bit, 
IN `p_EmpId` bigint, 
IN `p_FirstName` varchar(50), 
IN `p_LastName` varchar(50))
BEGIN
if(p_mode='EditOrView')
then 
select
t_EmpCode,
t_EmpFirstName,
t_EmpLastName,
n_DeptId,
n_PolicyId,
t_OfficePhone,
t_MobilePhone,
d_EmpDOB,
t_AddfLine,
t_AddSecLine,
t_AddThirdLine,
n_CountryId,
n_StateId,
n_CityId,
n_PinCode,
n_Status
from tblemployeemaster where a_EmpId=p_EmpId and  b_Deleted=0 and n_BusinessId=p_BusinessId;
end if;
if(p_mode='SelectList')
then 
select * from tblemployeemaster where  b_Deleted=0 and n_BusinessId=p_BusinessId ;
end if;
if(p_mode='SelectEdit')
then 
select tblemployeemaster.*,tblempaccessmap.a_EmpAccessMapId,tblempaccessmap.n_RoleAccessId,tblempaccessmap.n_AmtRange
from tblemployeemaster
left join tblempaccessmap on tblemployeemaster.a_EmpId=tblempaccessmap.n_EmpId where tblemployeemaster.a_EmpId=p_EmpId and tblempaccessmap.b_Deleted=0;
end if;

if(p_mode='SelectEmpEdit')
then 
select * from tblemployeemaster
where a_EmpId=p_EmpId and b_Deleted=0;
end if;

if(p_mode='SearchSelect')
then
select * from tblemployeemaster where is_Admin=p_IsAdmin and b_Deleted=0 and n_BusinessId=p_BusinessId and n_Status=1 and (t_EmpFirstName LIKE CONCAT('%',p_FirstName,'%') or t_EmpLastName LIKE CONCAT('%',p_LastName,'%'));
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_empemailcheck
DELIMITER //
CREATE  PROCEDURE `proc_empemailcheck`(IN `e_Email` VARCHAR(255))
BEGIN

SELECT COUNT(*) emailcorrect FROM tblemployeemaster WHERE t_EmaiId=e_Email;

END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_empgetcat
DELIMITER //
CREATE  PROCEDURE `proc_empgetcat`( in bid int(10))
begin 
  
	set  @value=(select a_policyid from tblpolicymaster where n_BusinessId=23);
     call proc_ssacatmapedit(@value);
     end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_EmployeeData
DELIMITER //
CREATE  PROCEDURE `proc_EmployeeData`(IN `p_mode` varchar(20), IN `p_id` INT, IN `p_emailId` varchar(100), IN `p_password` varchar(100))
BEGIN
if(p_mode='Selectlogin')
then 
select * from tblemployeemaster where t_EmaiId=p_emailId and t_Password=p_password and b_Deleted=0 and n_Status=1;
end if;
if(p_mode='UpdateLogin')
then
update tblemployeemaster 
set d_ModifiedOn=now() where a_EmpId=p_id;
end if;
if(p_mode='select')
then
select * from tblemployeemaster where a_EmpId=p_id;
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_EmployeeList
DELIMITER //
CREATE  PROCEDURE `proc_EmployeeList`(
p_startRowIndex int,                                                                            
p_maximumRows int,
p_EmpCode varchar(100),
p_CountryName varchar(100),
p_BusinessId int
)
BEGIN

SET p_startRowIndex =  (p_startRowIndex - 1)  * p_maximumRows  + 1;
IF (p_startRowIndex = 0)
then
SET p_startRowIndex = 1;  
end if;
SET @rank=0;      
DROP TEMPORARY TABLE IF EXISTS tt;                    
CREATE TEMPORARY TABLE IF NOT EXISTS tt AS
(
select @rank:=@rank+1 as SN,t1.* from (
select 
t_EmpCode,
t_EmpFirstName,
t_EmpLastName,
n_DeptId,
t_MobilePhone,
d_EmpDOB,
t_AddfLine,
n_CountryId
from tblemployeemaster where b_Deleted=0 and n_BusinessId=p_BusinessId
and (t_EmpCode=p_EmpCode or p_EmpCode is null)
and  (n_CountryId=p_CountryName or p_CountryName is null)
order by a_EmpId desc) as t1 
);
select * from tt  where SN BETWEEN p_startRowIndex AND (p_startRowIndex + p_maximumRows) - 1;                        
select COUNT(SN) from tt ;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_EmployeeMaster
DELIMITER //
CREATE  PROCEDURE `proc_EmployeeMaster`(
p_mode varchar(20),
p_EmpId bigint,
p_Empfname varchar(80),
p_EmpLastName varchar(80),
p_DeptId int,
p_EmpCode varchar(80),
p_PolicyId int,
p_EmpDob datetime,
p_OfficePhno varchar(20),
p_MobileNo varchar(15),
p_AddFLine varchar(150),
p_AddSecLine varchar(150),
p_AddThrdLine varchar(150),
p_Country int,
p_State int ,
p_City int,
p_PinCode int,
p_Status bit,
p_CreatedBy int,
p_BusinessId int
)
BEGIN
Declare p_msg bit;
DECLARE exit handler for sqlexception
  BEGIN
    set p_msg=false;
    select p_msg;
  ROLLBACK;
END;

DECLARE exit handler for sqlwarning
 BEGIN
 set p_msg=false;
    select p_msg;
 ROLLBACK;
END;
     
START TRANSACTION;   
set p_msg=true;
if(p_mode='Insert')
then
insert into tblemployeemaster
(
t_EmpCode,
t_EmpFirstName,
t_EmpLastName,
n_DeptId,
n_PolicyId,
t_OfficePhone,
t_MobilePhone,
d_EmpDOB,
t_AddfLine,
t_AddSecLine,
t_AddThirdLine,
n_CountryId,
n_StateId,
n_CityId,
n_PinCode,
n_Status,
d_CreatedOn,
n_CreatedBy,
n_BusinessId,
b_Deleted
)
values
(
p_EmpCode ,
p_Empfname ,
p_EmpLastName ,
p_DeptId ,
p_PolicyId ,
p_OfficePhno ,
p_MobileNo ,
p_EmpDob ,
p_AddFLine ,
p_AddSecLine ,
p_AddThrdLine ,
p_Country ,
p_State  ,
p_City ,
p_PinCode ,
p_Status ,
now(),
p_CreatedBy,
p_BusinessId,
0
);
end if;
if(p_mode='Update')
then
update tblemployeemaster set 
t_EmpCode=p_EmpCode,
t_EmpFirstName=p_Empfname,
t_EmpLastName=p_EmpLastName,
n_DeptId=p_DeptId,
n_PolicyId=p_PolicyId,
t_OfficePhone=p_OfficePhno,
t_MobilePhone=p_MobileNo,
d_EmpDOB=p_EmpDob,
t_AddfLine=p_AddFLine,
t_AddSecLine=p_AddSecLine,
t_AddThirdLine=p_AddThrdLine,
n_CountryId=p_Country,
n_StateId=p_State,
n_CityId=p_City,
n_PinCode=p_PinCode,
n_Status=p_Status,
d_CreatedOn=now(),
n_modifiedBy =p_CreatedBy,
d_modifiedOn = now()
where a_EmpId=p_EmpId and b_Deleted=0 and n_BusinessId=p_BusinessId;
end if;
select p_msg;
COMMIT; 
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_EmployeeNotesEditOrView
DELIMITER //
CREATE  PROCEDURE `proc_EmployeeNotesEditOrView`(
IN `p_mode` varchar(20),
IN `p_noteId` bigint(20),
IN `p_CreatedBy` int(20),
IN `p_Type` varchar(20),
IN `p_ReportId` bigint
)
BEGIN
if(p_mode='EditSelect')
then
SELECT 
a_NoteId,n_ReportId,t_NoteDesc,d_CreatedOn,
n_ModifiedBy,b_Deleted,n_CreatedBy,t_Type,d_ModifiedOn,
fn_GetLoginName(n_CreatedBy,t_Type) as t_Name
FROM trueexpence.tblrptnote
where n_ReportId=p_ReportId and b_Deleted=0;
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_EmployeeReport
DELIMITER //
CREATE  PROCEDURE `proc_EmployeeReport`(IN `report_name` varchar(100), IN `report_type` BIGINT, IN `status` varchar(100), IN `chaim_period_form` date, IN `cash_advance` decimal(15,3), IN `chaim_period_to` date, IN `description` varchar(200), IN `n_BusinessId` int, IN `n_AdminType` int, IN `row_id` int, IN `act_mode` varchar(50))
begin
declare lastId bigint;

if(act_mode='addempreport')then

insert into tblEmpExpRpt (
`t_ReportName`,
`n_ReportTypeId`,
`n_Status`,
`d_ClaimFrom`,
`n_CashAdvance`,
`d_ClaimTo`,
`n_PreExpAmt`) 
values(report_name,report_type,`status`,chaim_period_form,
cash_advance,chaim_period_to,description);

set lastId = (select last_insert_id());
select  lastId;

end if;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_EmployNotes
DELIMITER //
CREATE  PROCEDURE `proc_EmployNotes`(IN `n_ReportId` bigint, IN `notesvalue` longtext)
begin
declare xml_testing longtext;
 set xml_testing= notesvalue ;
 call proc_XmlInsert('tblrptnote',xml_testing,'t_NoteDesc,n_ReportId',concat(n_ReportId));
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_EmpProfileEditOrView
DELIMITER //
CREATE  PROCEDURE `proc_EmpProfileEditOrView`(IN `e_Id` INT, IN `e_Dob` DATETIME, IN `e_Mobile` VARCHAR(100), IN `e_Phone` VARCHAR(100), IN `e_Address1` VARCHAR(255), IN `e_Address2` VARCHAR(250), IN `e_Address3` VARCHAR(255), IN `e_Country` INT, IN `e_State` INT, IN `e_City` INT, IN `e_Pin` VARCHAR(50), IN `e_Seq` VARCHAR(255), IN `act_mode` VARCHAR(100))
BEGIN 

IF(`act_mode`='view') THEN

SELECT * FROM tblemployeemaster WHERE a_EmpId=e_Id;

END IF;

IF(`act_mode`='update')THEN

UPDATE tblemployeemaster SET
d_EmpDOB = e_Dob,
t_MobilePhone = e_Mobile,
t_OfficePhone = e_Phone,
t_AddfLine = e_Address1,
t_AddSecLine =e_Address2,
t_AddThirdLine =e_Address3,
n_CountryId = e_Country,
n_StateId = e_State,
n_CityId = e_City,
n_PinCode = e_Pin,
n_seqAns = e_Seq,
d_ModifiedOn = NOW() WHERE a_EmpId=e_Id;

END IF;

END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_ExpenseViewAdmin
DELIMITER //
CREATE  PROCEDURE `proc_ExpenseViewAdmin`(
IN `p_mode` varchar(20),
IN `p_CustCatId` bigint(20),
IN `p_ReportId` bigint
)
BEGIN
if(p_mode='SelectList')
then
SELECT tblexppolicymap.*,tblcustomcategory.t_CustCatName,tblsettingtype.t_EnumTypeDescription,tblsettingtype.t_EnumKey
FROM tblexppolicymap
left join  tblcustomcategory on tblexppolicymap.n_CategoriesID=tblcustomcategory.a_CustCatId 
left join tblsettingtype on tblexppolicymap.n_ExpType=tblsettingtype.a_EnumId
where tblexppolicymap.n_ReportId=p_ReportId and tblexppolicymap.b_Deleted=0;
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_ExpPolicyMap
DELIMITER //
CREATE  PROCEDURE `proc_ExpPolicyMap`(
IN eReportId bigint,
IN category bigint,
IN datevalue date,
IN DateFrom date,
IN DateTo date,
In CategoriesID bigint,
IN Distance decimal (10,0),
IN amount decimal(10,2),
IN merchant varchar (240),
IN purpose text,
IN reimb bigint,
IN tag varchar (20),
IN atthFile varchar (240),
IN row_id bigint,
IN act_mode varchar(50))
insert into tblexppolicymap (
n_ReportId,
n_ExpType,
d_Date,
t_Amount,
t_Merchant,
t_Purpose,
b_IsReimburs,
n_CustomTag1,
t_atthFile

 ) 
values(
eReportId,
category,
datevalue,
amount,
merchant,
purpose,
reimb,
tag,
atthFile
)//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_getdptmt
DELIMITER //
CREATE  PROCEDURE `proc_getdptmt`(IN `act_mode` varchar(50), IN `n_business` int(10))
begin 
if (act_mode='department')then 
select t_DeptName from  tbldepartment where n_BusinessId= n_business;
end if ;
if (act_mode='sp_cat')then 
select a_SpndngCatId , t_SpndName , t_GLCode from  tblspndngcat where n_BusinessId= n_business;
end if ;
if (act_mode='custon_tag')then 
select a_CustTagId , t_CustText, t_CustValue  from  tblcustomtag where n_BusinessId= n_business;
end if ;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_getpass
DELIMITER //
CREATE  PROCEDURE `proc_getpass`(IN `bemail` varchar(255), IN `bseq` varchar (255) , IN `bpass` varchar (255))
begin
UPDATE tbl_businessadmin SET t_password=bpass WHERE t_Email=bemail and n_seqcode=bseq;

SELECT t_FirstName AS Fname , t_LastName AS Lname FROM tbl_businessadmin WHERE t_Email=bemail and n_seqcode=bseq;

end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_menu
DELIMITER //
CREATE  PROCEDURE `proc_menu`(IN `p_menuname` varchar(255), IN `t_url` varchar(255), IN `p_type` int(11) , IN `p_mode` VARCHAR(255))
begin
	declare out_param int(11);
	
	if(p_mode='pselect')
	then
		select * from `tbl_menu` where n_ParentId = p_type; 
	end if;
	
	if(p_mode='pinsert')
	then
	insert into `tbl_menu` (`t_menuname`,`t_url`, `n_ParentId`) values (p_menuname,t_url, p_type);
	SET out_param = LAST_INSERT_ID();
	 select out_param;
	end if;

end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_PolicyCatMap
DELIMITER //
CREATE  PROCEDURE `proc_PolicyCatMap`(
p_mode varchar(20),
p_PlcyCatMapId int,
p_XmlDatatest longtext,
p_PolicyId int,
p_CreatedBy int,
p_BusinessId int
)
BEGIN
declare xml_testing longtext;
if(p_mode='Insert')
then
set xml_testing= p_XmlDatatest;
call proc_XmlInsert('tblpolicycategorymap',
  xml_testing,
'n_SpndngCatId,n_SingleExpLmt,n_DailyExpLmt,n_MonthlyExpLmt,
  n_PolicyId,
  d_CreatedOn,
  n_CreatedBy,
  b_Deleted,
  n_BusinessId'
  ,concat(p_PolicyId,',',now(),',',p_CreatedBy,
  ',',0,',',p_BusinessId));
end if;   
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_PolicyEditOrView
DELIMITER //
CREATE  PROCEDURE `proc_PolicyEditOrView`(
IN p_mode varchar(20),
IN p_formName varchar(30),
IN p_BusinessId int,
IN p_PolicyId bigint,
IN p_AdminType int
)
BEGIN 
if(p_mode='select')
then
select a_PolicyId,t_PolicyName,d_ModifiedOn,fn_getloginname(n_modifiedby,t_ModifiedByType) as t_name 
from tblpolicymaster 
where n_BusinessId=p_BusinessId and b_Deleted=0;
end if;
if(p_mode='SelectEdit')
then
select tblpolicymaster.*,tblpolicycategorymap.n_DailyExpLmt as dailyExpLmtMap,tblpolicycategorymap.n_MonthlyExpLmt as monthlyExpLmtMap,
tblpolicycategorymap.n_SingleExpLmt,tblpolicycategorymap.n_SpndngCatId,fn_GetSpendCatName(n_SpndngCatId) as t_SpnCatName
from tblpolicymaster
left join tblpolicycategorymap on tblpolicymaster.a_PolicyId=tblpolicycategorymap.n_PolicyId
where tblpolicymaster.a_Policyid=p_PolicyId;
end if;
if(p_mode='EditOrViewPolicy')
then
if(p_formName='First')
then
select * from tblpolicymaster where  n_BusinessId=p_BusinessId and a_policyId=p_PolicyId;
end if;
if(p_formName='second')
then
select n_MilageRate,
n_MilRateUnitValue,
n_MaxRptMilage,
n_MaxExpMil,
b_IsGPSReq from tblpolicymaster where n_BusinessId=p_BusinessId and a_PolicyId=p_PolicyId;
end if;
if(p_formName='Third')
then
select
n_MonthlyExpLmt,
n_DailyExpLmt
from tblpolicymaster where n_BusinessId=p_BusinessId and a_PolicyId=p_PolicyId;
end if;

end if;
if(p_mode='Delete')
then
update  tblpolicymaster set  b_deleted=1  where n_BusinessId=p_BusinessId and a_PolicyId=p_PolicyId;
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_PolicyList
DELIMITER //
CREATE  PROCEDURE `proc_PolicyList`(
p_startRowIndex int,                                                                            
p_maximumRows int,
p_PolicyName varchar(100),
p_BusinessId int
)
BEGIN
SET p_startRowIndex =  (p_startRowIndex - 1)  * p_maximumRows  + 1;
IF (p_startRowIndex = 0)
then
SET p_startRowIndex = 1;  
end if;
SET @rank=0;      
DROP TEMPORARY TABLE IF EXISTS tt;                    
CREATE TEMPORARY TABLE IF NOT EXISTS tt AS
(
select @rank:=@rank+1 as SN,t1.* from (
select 
t_PolicyName,
n_MaxRptAmt,
n_MaxExpAmt,
n_ReportDueBy,
n_MilageRate,
n_MaxRptMilage,
n_MaxExpMil,
n_MonthlyExpLmt
from tblpolicymaster where b_Deleted=0 and n_BusinessId=p_BusinessId
and (t_PolicyName=p_PolicyName or p_PolicyName is null)
order by a_PolicyId desc) as t1 
);
select * from tt  where SN BETWEEN p_startRowIndex AND (p_startRowIndex + p_maximumRows) - 1;                        
select COUNT(SN) from tt ;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_PolicyMaster
DELIMITER //
CREATE  PROCEDURE `proc_PolicyMaster`(
IN `p_mode` varchar(20), 
IN `p_formName` varchar(20), 
IN `p_PolicyId` bigint, 
IN `p_PolicyName` varchar(50), 
IN `p_MaxRptAmt` INT, 
IN `d_RptDueDt` VARCHAR(50), 
IN `d_RptDueDt1` VARCHAR(50), 
IN `p_MaxExpAmt` decimal(15,2), 
IN `p_RptDueDate` datetime, 
IN `p_CashAdvAllowed` bit, 
IN `p_RecpReq` DECIMAL(15,2), 
IN `p_AboveAmt` DECIMAL(15,2), 
IN `p_MaxRptMilage` int, 
IN `p_MilageRate` decimal(15,2),
IN `p_PerMeasuremnt` int, 
IN `p_MilRateUnitValue` int , 
IN `p_MaxExpMil` decimal(15,2) , 
IN `p_IsGPSReq` bit,
IN `p_CreatedBy` int, 
IN `p_MonthlyExpLmt` decimal(15,2), 
IN `p_DailyExpLmt` decimal(15,2), 
IN `p_ReportDueBy` int , 
IN `p_flagExpSubmitted` varchar(80), 
IN `p_BusinessId` int, 
IN `p_AdminType` int, 
IN `p_RptDueByValue` int
)
BEGIN
declare p_a_PolicyId bigint;
if(p_mode='Insert')
then
if exists (select a_PolicyId from tblpolicymaster where  p_formName='Third')
then
update tblpolicymaster set
n_MonthlyExpLmt=p_MonthlyExpLmt,
n_DailyExpLmt=p_DailyExpLmt,
n_ModifiedBy=p_CreatedBy ,
d_ModifiedOn=now() 
where  a_PolicyId=p_PolicyId;
end if;

if exists  (select a_PolicyId from tblpolicymaster where  p_formName='Second')
then

update tblpolicymaster set 
n_MilageRate=p_MilageRate,
n_MilRateUnitValue=p_MilRateUnitValue,
n_MaxRptMilage=p_MaxRptMilage,
n_MaxExpMil=p_MaxExpMil,
b_IsGPSReq=p_IsGPSReq,
n_ModifiedBy=p_CreatedBy ,
d_ModifiedOn=now() 
where  a_PolicyId=p_PolicyId;

end if;

if(p_formName='First')
then
insert into tblpolicymaster(
t_PolicyName,
n_MaxRptAmt,
d_RptDueDt,
d_RptDueDt1,
n_MaxExpAmt,
b_CashAdAllowed,
b_RecpReq,
n_AboveAmt,
d_CreatedOn,
n_CreatedBy,
n_BusinessId,
n_AdminType
)
 values
(p_PolicyName,p_MaxRptAmt,d_RptDueDt,d_RptDueDt1,p_MaxExpAmt,p_CashAdvAllowed,p_RecpReq,
p_AboveAmt,now(),p_CreatedBy,p_BusinessId,p_AdminType
);
set p_a_PolicyId = (select last_insert_id());
select  p_a_PolicyId;
end if;
end if; 
if(p_mode='Update')
then
SET SQL_SAFE_UPDATES=0;
if (p_formName='First')
then
update tblpolicymaster set 
n_MaxRptAmt=p_MaxRptAmt,
n_MaxExpAmt=p_MaxExpAmt,
n_ReportDueBy=p_ReportDueBy,
n_RptDueByValue=p_RptDueByValue,
b_CashAdAllowed=p_CashAdvAllowed,
t_flagExpSubmitted=p_flagExpSubmitted,
n_ModifiedBy=p_CreatedBy ,
d_ModifiedOn=now() 
where  a_PolicyId=p_PolicyId;
end if;
if(p_formName='Second')
then
update tblpolicymaster set 
n_MaxRptMilage=p_MaxRptMilage,
n_MilageRate=p_MilageRate,
n_PerMeasuremnt=p_PerMeasuremnt,
n_MaxExpMil=p_MaxExpMil,
b_IsGPSReq=p_IsGPSReq,
n_ModifiedBy=p_CreatedBy ,
d_ModifiedOn=now() 
where  a_PolicyId=p_PolicyId;
end if;

if(p_formName='Third')
then
update tblpolicymaster set
n_MonthlyExpLmt=p_MonthlyExpLmt,
n_DailyExpLmt=p_DailyExpLmt,
n_ModifiedBy=p_CreatedBy ,
d_ModifiedOn=now() 
where  a_PolicyId=p_PolicyId;
end if;
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_rememberment
DELIMITER //
CREATE  PROCEDURE `proc_rememberment`(IN `n_businessId` int(10) , IN `p_reimb` int(10))
begin 
update tblbusiness set 
n_reimb = p_reimb
where a_BusinessId  = n_businessId;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_reportEditOrView
DELIMITER //
CREATE  PROCEDURE `proc_reportEditOrView`(
IN `p_mode` varchar(255), 
IN `p_reportId` int, 
IN `b_Active` bit(1),
IN `p_EmpId` int, 
IN `p_CreatedBy` int, 
IN `p_BusinessId` INT,
IN `p_Status` ENUM('save','submit','Delete'),
IN `p_ApprovedBy` int,
IN `p_DeptId` int,
IN `p_Approved` bit,  
IN `p_AdminType` INT
)
BEGIN
if(`p_BusinessId`=null)
then
if(`p_mode` = 'select')
then
select tblempexprpt.*,tblemployeemaster.t_EmpFirstName,tblemployeemaster.t_EmpLastName 
from tblempexprpt 
LEFT JOIN tblemployeemaster On tblempexprpt.n_CreatedBy=tblemployeemaster.a_EmpId
where tblempexprpt.n_status like '%submit%' and tblempexprpt.n_AdminType=p_AdminType;
end if;
if(`p_mode` = 'editselect')
then
select * from `tblcountry` where b_IsActive = active AND a_CountryId= id;
end if;
if(p_mode='delete')
then
update tblrptnote set
b_Deleted=1,
n_ModifiedBy=p_createdBy ,
d_ModifiedOn=now() 
where  a_NoteId=p_noteId;
end if;
else
if(`p_mode` = 'select')
then
select tblempexprpt.*,tblemployeemaster.t_EmpFirstName,tblemployeemaster.t_EmpLastName
from tblempexprpt 
left join tblemployeemaster on tblempexprpt.n_CreatedBy=tblemployeemaster.a_EmpId
where tblempexprpt.n_status like '%submit%' and b_Approved=0 and tblempexprpt.n_DeptId=p_DeptId and tblempexprpt.n_BusinessId=p_BusinessId;
end if;

if(`p_mode` = 'EmpIdBasedReport')
then
select tblempexprpt.*,tblemployeemaster.t_EmpFirstName,tblemployeemaster.t_EmpLastName 
from tblemployeemaster
left join tblempexprpt on tblemployeemaster.a_EmpId=tblempexprpt.n_CreatedBy
where tblemployeemaster.a_EmpId=p_EmpId and tblempexprpt.n_DeptId=p_DeptId and tblempexprpt.n_status like '%submit%' and tblempexprpt.b_Deleted=0;
end if;

if(`p_mode` = 'editselect')
then
select tblempexprpt.*,tbldepartment.t_DeptName,tblemployeemaster.t_EmpFirstName,tblemployeemaster.t_EmpLastName,tblemployeemaster.n_PolicyId
from tblempexprpt
left join  tbldepartment on tblempexprpt.n_DeptId=tbldepartment.a_DeptId
left join tblemployeemaster on tblempexprpt.n_CreatedBy=tblemployeemaster.a_EmpId
where tblempexprpt.a_ReportId=p_reportId and tblempexprpt.n_status like '%submit%' and tblempexprpt.n_DeptId=p_DeptId and tblempexprpt.n_BusinessId=p_BusinessId;
end if;
if(p_mode='approved')
then
update tblempexprpt set
b_Approved=1,
n_ApprovedBy=p_createdBy,
d_ApprovedOn=now() 
where  a_ReportId=p_reportId;
end if;
if(p_mode='reject')
then
update tblempexprpt set
n_status='Reject',
n_ModifiedBy=p_createdBy,
n_ModifiedOn=now() 
where  a_ReportId=p_reportId;
end if;
if(p_mode='downloadReport')
then
select tblempexprpt.*,tbldepartment.t_DeptName,tblrptnote.t_NoteDesc,tblrptnote.d_CreatedOn,tblrptnote.t_Type,fn_GetLoginName(tblrptnote.n_CreatedBy,tblrptnote.t_Type) as t_Name ,
tblemployeemaster.t_EmpFirstName,tblemployeemaster.t_EmpLastName,
fn_GetpolicyName(n_PolicyId) as policyName,fn_GetCatName(n_CategoriesID) as categoryName,tblexppolicymap.*
from tblempexprpt
left join  tblrptnote on tblempexprpt.a_ReportId=tblrptnote.n_ReportId
left join  tblexppolicymap on tblempexprpt.a_ReportId=tblexppolicymap.n_ReportId
left join  tbldepartment on tblempexprpt.n_DeptId=tbldepartment.a_DeptId
left join tblemployeemaster on tblempexprpt.n_CreatedBy=tblemployeemaster.a_EmpId
left join tbl_businessadmin on tblempexprpt.n_BusinessId=tbl_businessadmin.a_BusnAdminId
where tblempexprpt.a_ReportId=p_reportId and tblempexprpt.n_status like '%submit%' and tblempexprpt.n_DeptId=p_DeptId and tblempexprpt.n_BusinessId=p_BusinessId;
end if;
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_resetpass
DELIMITER //
CREATE  PROCEDURE `proc_resetpass`(IN `bid` INT , IN `bpass` VARCHAR (255) , IN `act_mode` VARCHAR(255))
BEGIN
if(`act_mode`='checkpass')then
SELECT COUNT(*) AS correctpass FROM tbl_businessadmin WHERE n_BusinessId=bid AND t_password=bpass;
end if;

if(`act_mode`='reset')then
UPDATE tbl_businessadmin SET t_password=bpass WHERE  n_BusinessId=bid;
end if;

if(`act_mode`='checkpassadmin')then
SELECT COUNT(*) AS correctpass FROM tbl_systemlogin WHERE a_SysloginId=bid AND t_password=bpass;
end if;

if(`act_mode`='resetadmin')then
UPDATE tbl_systemlogin SET t_password=bpass WHERE  a_SysloginId=bid;
end if;



END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_SaveCustom
DELIMITER //
CREATE  PROCEDURE `proc_SaveCustom`(
p_mode varchar(20),
p_CustCatId bigint,
p_CustCatName varchar(80),
p_CustText varchar(150),
p_CustValue varchar(50),
p_CreatedBy int,
p_CreatedOn datetime,
p_BusinessId int,
p_AdminType int 
)
BEGIN
-- Declare p_a_CustCatId bigint;
Declare p_msg bit;
DECLARE exit handler for sqlexception
  BEGIN
    set p_msg=false;
    select p_msg;
  ROLLBACK;
END;
DECLARE exit handler for sqlwarning
 BEGIN
 set p_msg=false;
    select p_msg;
 ROLLBACK;
END;
START TRANSACTION;   
set p_msg=true; 
if(p_mode='Insert')
then
insert into tblcustomcategory(
t_CustCatName,
n_CreatedBy ,
d_CreatedOn ,
n_BusinessId ,
b_Deleted,
n_AdminType
)
values(
p_CustCatName,
p_CreatedBy ,
now() ,
p_BusinessId  ,
0,
p_AdminType
);
set @p_a_CustCatId=(SELECT LAST_INSERT_ID());

insert into tblcustomtag
(
t_CustText,
t_CustValue,
n_CustCatId,
n_CreatedBy ,
d_CreatedOn ,
n_BusinessId,
n_AdminType  
)
values
(
p_CustText,
p_CustValue,
@p_a_CustCatId,
p_CreatedBy ,
now() ,
p_BusinessId  ,
p_AdminType
);
end if;
if(p_mode='Update')
then
SET SQL_SAFE_UPDATES=0;
update tblcustomcategory set t_CustCatName =p_CustCatName where a_CustCatId=p_CustCatId and b_Deleted=0;
update tblcustomtag set t_CustText=p_CustText ,t_CustValue=p_CustValue where n_CustCatId=p_CustCatId and b_Deleted=0;
end if;
select p_msg;
COMMIT;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_saveSettingVal
DELIMITER //
CREATE  PROCEDURE `proc_saveSettingVal`(IN `p_mode` VARCHAR(50), IN `p_id` INT, IN `p_enumId` INT, IN `p_SettingValue` VARCHAR(255), IN `p_CreatedBy` int, IN `p_active` BIT, IN `p_BusinessId` bigint, IN `p_AdminType` int
)
BEGIN
declare T_n_value bigint;
declare T_n_Priority bigint;
if(p_mode='Insert')
then
if(0=(select Count(a_SettingId) from tblsettingvalue))
then
insert into tblsettingvalue(t_SettingValue,n_EnumId,n_ValueId,n_Priority,n_CreatedOn,n_CreatedBy,b_IsActive,n_BusinessId,n_AdminType)
values(p_SettingValue,p_enumId,1,1,now(),p_CreatedBy,p_active,p_BusinessId,p_AdminType);
 end if;
if((select Count(a_SettingId) from tblsettingvalue)>0)
then
set T_n_value= (SELECT  n_ValueId+1 FROM tblsettingvalue
ORDER BY a_SettingId DESC
limit 1);
set T_n_Priority= (SELECT n_Priority+1 FROM tblsettingvalue
ORDER BY a_SettingId DESC
limit 1);

insert into tblsettingvalue(t_SettingValue,n_EnumId,n_ValueId,n_Priority,n_CreatedOn,n_CreatedBy,b_IsActive,n_BusinessId,n_AdminType)
values(p_SettingValue,p_enumId,T_n_value,T_n_Priority,now(),p_CreatedBy,p_active,p_BusinessId,p_AdminType);

end if;
end if;
if(p_mode='Update')
then
update tblsettingvalue set 
t_SettingValue=p_SettingValue,
n_ModifiedOn=now(),
n_ModifiedBy=p_CreatedBy where a_SettingId=p_id and n_AdminType=p_AdminType;
end if;
if(p_mode='Delete')
then
DELETE from tblsettingvalue where a_SettingId=p_id;
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_SpendingCategory
DELIMITER //
CREATE  PROCEDURE `proc_SpendingCategory`(
p_SpndngCatId bigint,
p_mode varchar(20),
p_SpndName varchar(50),
p_GLCode varchar(50),
p_CreatedBy int,
p_AdminType int,
p_BusinessId int
)
BEGIN
if(p_mode='Select')
then
select a_spndngcatId,t_SpndName from tblspndngcat 
where n_BusinessId=p_BusinessId and b_Deleted=0;
end if;
if(p_mode='Insert')
then
insert into tblspndngcat
(
t_SpndName,
t_GLCode,
n_CreatedBy, 
d_CreatedOn,
n_AdminType,
n_BusinessId,
b_Deleted
)
values
(
p_SpndName,
p_GLCode,
p_CreatedBy,
now(),
p_AdminType,
p_BusinessId,
0
);
end if; 
if(p_mode='Update')
then
update tblspndngcat set 
t_SpndName=p_SpndName,
t_GLCode=p_GLCode,
n_ModifiedBy=p_CreatedBy, 
d_ModifiedOn=now(),
n_AdminType=p_AdminType where a_SpndngCatId=p_SpndngCatId and b_Deleted=0 and n_BusinessId=p_BusinessId;
end if;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_ssaallbusiness
DELIMITER //
CREATE  PROCEDURE `proc_ssaallbusiness`()
begin 

select a_BusinessId , t_BusinessName  from tblbusiness where b_Deleted =0;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_ssabachangepassans
DELIMITER //
CREATE  PROCEDURE `proc_ssabachangepassans`(IN `act_mode` varchar(50), IN `businessid` int , IN `anspass` varchar(100))
begin 
if(act_mode='answer') then
update tbl_businessadmin set
n_seqcode =anspass
where a_BusnAdminId =businessid;
end if;
if(act_mode='password') then
update tbl_businessadmin set
t_password =anspass
where a_BusnAdminId =businessid;
end if;

if(act_mode='eanswer') then
update tblemployeemaster set
n_seqAns =anspass
where a_EmpId =businessid;
end if;
if(act_mode='epassword') then
update tblemployeemaster set
t_Password =anspass
where a_EmpId =businessid;
end if;

if(act_mode='sanswer') then
update tbl_systemlogin set
n_sec_answ =anspass
where a_SysloginId =businessid;
end if;
if(act_mode='spassword') then
update tbl_systemlogin set
t_password =anspass
where a_SysloginId =businessid;
end if;
   
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_ssacatmapedit
DELIMITER //
CREATE  PROCEDURE `proc_ssacatmapedit`(IN `policyid` int(20) )
begin
select tsc.a_SpndngCatId ,
 tsc.t_SpndName , tcm.n_PolicyId ,tcm.n_SpndngCatId 
 ,tcm.n_SingleExpLmt,tcm.n_DailyExpLmt ,tcm.n_MonthlyExpLmt
  from tblpolicycategorymap tcm 
inner join tblspndngcat tsc 
on tcm.n_SpndngCatId=tsc.a_SpndngCatId  where tcm.n_PolicyId=policyid;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_ssaemploylock
DELIMITER //
CREATE  PROCEDURE `proc_ssaemploylock`(IN `act_mode` varchar(100) , IN `id` int (10) , IN `bdel` int(10))
begin
if(act_mode ='allview')then 
select tbm.n_BusinessId ,tbs.a_BusinessId ,tbm.b_Deleted ,tbm.n_DeptId,td.a_DeptId , 
tbm.t_EmpCode , tbm.b_Deleted,
tbm.t_EmpFirstName,tbm.t_EmpLastName,tbm.a_EmpId,tbm.t_EmaiId,tbs.t_BusinessName
,td.t_DeptName
from tblemployeemaster tbm inner join 
 tblDepartment td on tbm.n_DeptId=td.a_DeptId 
 inner join  tblBusiness tbs on  tbm.n_BusinessId=tbs.a_BusinessId 
 where tbm.b_Deleted !='1' ;
end if ;
if(act_mode='delete') then 
update  tblemployeemaster set
b_Deleted=bdel 
where a_EmpId = id;
end if;

if(act_mode ='allviewbyid')then 
select tbm.n_BusinessId ,tbs.a_BusinessId ,tbm.b_Deleted ,tbm.n_DeptId,td.a_DeptId , 
tbm.t_EmpCode , tbm.b_Deleted,
tbm.t_EmpFirstName,tbm.t_EmpLastName,tbm.a_EmpId,tbm.t_EmaiId,tbs.t_BusinessName
,td.t_DeptName
from tblemployeemaster tbm inner join 
 tblDepartment td on tbm.n_DeptId=td.a_DeptId 
 inner join  tblBusiness tbs on  tbm.n_BusinessId=tbs.a_BusinessId 
 where tbm.b_Deleted !='1' AND tbm.n_BusinessId=id ;
end if ;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_ssagetbusiness
DELIMITER //
CREATE  PROCEDURE `proc_ssagetbusiness`(IN `act_mode` varchar(20), IN `adm_type` INT, IN `admin_id` INT)
begin
if(act_mode='get_business') then
select tbs.a_BusinessId ,tbs.t_BusinessName from tbl_businessadmin tba  inner join  tblbusiness tbs on tba.n_BusinessId=tbs.a_BusinessId 
where tba.n_AdminType='33' and tba.n_CreatedBy='1' and tbs.b_Deleted !='1' ;
end if;
if(act_mode='getallbusiness') then 
select * from tblbusiness where  b_Deleted ='0';
end if;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_ssapassreset
DELIMITER //
CREATE  PROCEDURE `proc_ssapassreset`(IN `email` varchar(100), IN `asn` VARCHAR(50), IN `act_mode` VARCHAR(50))
begin
if(act_mode='mailcheck') then 
select count(*) as correctemail  from `tbl_systemlogin` where t_username =email;
end if;
if(act_mode='ansmailcheck') then
select count(*) as correctemailans  from `tbl_systemlogin` where t_username =email and n_sec_answ = asn;
end if;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_ssapassupdate
DELIMITER //
CREATE  PROCEDURE `proc_ssapassupdate`(IN `email` varchar(100), IN `ans` varchar(100) , IN `pass` varchar(100))
begin 
update tbl_systemlogin set 
t_password = pass 
where  t_username= email and   n_sec_answ = ans;

select* from tbl_systemlogin  
where t_username= email and   n_sec_answ = ans;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_ssapolicy
DELIMITER //
CREATE  PROCEDURE `proc_ssapolicy`(IN `act_mode` varchar (50) , IN `id` int(10))
begin 
if(act_mode='allview') then
select tpm.n_ModifiedBy,tda.a_SysloginId,tpm.a_PolicyId,
tpm.t_PolicyName,tda.t_username ,tda.firstName,tda.lastName,tpm.d_ModifiedOn
 from  tblpolicymaster tpm inner join tbl_systemlogin
 tda on tpm.b_Deleted=tda.b_Deleted  where tpm.b_Deleted !='1' and tpm.n_AdminType='33' group by(tpm.a_PolicyId);

end if;
if(act_mode ='view') then

select* from tblpolicymaster where  a_PolicyId =id;
end if ;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_ssapolicycatmulty
DELIMITER //
CREATE  PROCEDURE `proc_ssapolicycatmulty`(IN `p_mode` varchar (50) , IN `dpolicyid` INT, IN `p_XmlData_tag_gl` LONGTEXT, IN `p_CreatedBy` INT, IN `p_AdminType` INT, IN `p_BusinessId` INT)
BEGIN
declare xml_testing longtext;

if(p_mode='update') then
delete from tblpolicycategorymap where n_PolicyId =dpolicyid;
set xml_testing= p_XmlData_tag_gl;
select xml_testing;
call proc_XmlInsert('tblpolicycategorymap',
 xml_testing,
 'n_PolicyId,
  n_SpndngCatId,
  n_SingleExpLmt,
  n_DailyExpLmt,
  n_MonthlyExpLmt,
  d_CreatedOn,
  n_CreatedBy,
  b_Deleted,
  n_ModifiedBy,         
  n_BusinessId'
  ,concat(now(),',',p_CreatedBy,',',false,
  ',',p_AdminType,
  ',',p_BusinessId));

end if;


if(p_mode='Insert')
then
set xml_testing= p_XmlData_tag_gl;
select xml_testing;
call proc_XmlInsert('tblpolicycategorymap',
 xml_testing,
 'n_PolicyId,
  n_SpndngCatId,
  n_SingleExpLmt,
  n_DailyExpLmt,
  n_MonthlyExpLmt,
  d_CreatedOn,
  n_CreatedBy,
  b_Deleted,
  n_ModifiedBy,         
  n_BusinessId'
  ,concat(now(),',',p_CreatedBy,',',false,
  ',',p_AdminType,
  ',',p_BusinessId)); 
end if;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_ssapolicyeidt
DELIMITER //
CREATE  PROCEDURE `proc_ssapolicyeidt`(IN `act_mode` varchar(10) , IN `act_mode1` varchar(10)
, IN `id` int(12), IN `policyname` VARCHAR(50), IN `p_MaxRptAmt` VARCHAR(50), IN `p_RptDueDt` VARCHAR(50), IN `p_RptDueDt1` INT, IN `p_MaxExpAmt` INT, IN `p_CashAdAllowed` INT, IN `p_RecpReq` INT, IN `p_AboveAmt` VARCHAR(50), IN `p_expense_submitted` vARCHAR(50), IN `businessId` INT, IN `admintype` INT, IN `createdby` INT)
begin
if(act_mode1='update') then
update tblpolicymaster set 
t_PolicyName = policyname,
n_MaxRptAmt =p_MaxRptAmt,
d_RptDueDt= p_RptDueDt1 ,
d_RptDueDt1= p_RptDueDt1 ,
n_MaxExpAmt= p_MaxExpAmt ,
b_CashAdAllowed= p_CashAdAllowed ,
b_RecpReq= p_RecpReq ,
n_AboveAmt= p_AboveAmt ,
t_flagExpSubmitted = p_expense_submitted

where a_PolicyId =id;
select 1 as result;
end if;

if(act_mode1='Insert') then
insert into tblpolicymaster (t_PolicyName,n_MaxRptAmt,d_RptDueDt,d_RptDueDt1,n_MaxExpAmt,
b_CashAdAllowed,b_RecpReq,n_AboveAmt,t_flagExpSubmitted,
n_CreatedBy,n_BusinessId,n_AdminType)
 values (policyname,p_MaxRptAmt,p_RptDueDt1
,p_RptDueDt1,p_MaxExpAmt,p_CashAdAllowed,p_RecpReq,p_AboveAmt,p_expense_submitted,
createdby,businessId,admintype); 
 select last_insert_id() as lastid;
end if;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_ssapolicymilig
DELIMITER //
CREATE  PROCEDURE `proc_ssapolicymilig`(IN `act_mode1` varchar(50), IN `act_mode` varchar(50) , IN `id` INT, IN `p_MaxRptMilage` DECIMAL(10,5), IN `p_MilageRate` DECIMAL(10,5), IN `p_PerMeasuremnt` INT, IN `p_MaxExpMil` DECIMAL(10,5), IN `p_IsGPSReq` INT)
begin 
update tblpolicymaster set 
 n_MaxRptMilage=p_MaxRptMilage,
    n_MilageRate=p_MilageRate,
    n_PerMeasuremnt=p_PerMeasuremnt,
    n_MaxExpMil=p_MaxExpMil,
    b_IsGPSReq=p_IsGPSReq
where a_PolicyId =id;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_ssapolicyspndlmt
DELIMITER //
CREATE  PROCEDURE `proc_ssapolicyspndlmt`(IN `act_mode` varchar(50) , IN `act_mode1` varchar(50), IN `id` int(10), IN `p_DailyExpLmt` DECIMAL(10,2), IN `p_MonthlyExpLmt` DECIMAL(10,2))
begin 
update tblpolicymaster set 
 n_DailyExpLmt=p_DailyExpLmt,
    n_MonthlyExpLmt=p_MonthlyExpLmt
    
where a_PolicyId =id;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_ssaspndcatlist
DELIMITER //
CREATE  PROCEDURE `proc_ssaspndcatlist`(in anc_mode varchar(50))
begin 
select * from tblspndngcat where  b_Deleted !='1'; 
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_sysadmindelete
DELIMITER //
CREATE  PROCEDURE `proc_sysadmindelete`(IN `row_id` int, IN `sys_status` VARCHAR (70), IN `act_mode` VARCHAR (100) )
begin

 if(`act_mode`='admindelete')
 THEN
 
 update  tbl_systemlogin set 
`IsActive`='Delete'
 where `a_SysloginId`=row_id;

 end if;


 if(`act_mode`='adminactive')then

 update tbl_systemlogin set
`IsActive`= sys_status 
 where `a_SysloginId`=row_id;
 
 end if;
 
 if(`act_mode`='varifyemail') then
 
 UPDATE tbl_systemlogin SET 
 
 IsActive='Active'
 WHERE `t_password`=sys_status && `a_SysloginId`=row_id;
 
 end if;
 
 
 end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_sysprofileupdate
DELIMITER //
CREATE  PROCEDURE `proc_sysprofileupdate`(IN `s_Id` INT , IN `s_Country` INT, IN `s_State` INT, IN `s_Address` VARCHAR(255), IN `s_Seq` VARCHAR(255))
BEGIN 
 UPDATE tbl_systemlogin SET 
 n_CityId = s_Country,
 n_StateId = s_State,
 t_Address =s_Address, 
 n_modifiedby = s_Id,
 n_sec_answ = s_Seq,
 d_modifiedon = NOW() 
 where a_SysloginId = s_Id;


END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_tblspndngcatlist
DELIMITER //
CREATE  PROCEDURE `proc_tblspndngcatlist`(IN n_businessId int(10) , IN  p_reimb varchar (100))
begin 
select * from tblspndngcat
where n_BusinessId  = n_businessId and b_Deleted !='1';
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_updateglcodtxt
DELIMITER //
CREATE  PROCEDURE `proc_updateglcodtxt`( in act_mode varchar(100) , in glcodetext varchar(100), catname varchar(100) , in id int(10))
begin 
if(act_mode='sp_cat')then
update tblspndngcat set 
t_GLCode = glcodetext 
where a_SpndngCatId = id;
end if;

if(act_mode='custon_tag')then
update tblcustomtag set 
t_CustValue = glcodetext 
where a_CustTagId = id;
end if;
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_updatesysteradmin
DELIMITER //
CREATE  PROCEDURE `proc_updatesysteradmin`(IN `p_firstName` varchar(255), IN `p_lastName` varchar(255), IN `id` INT, IN `n_CountryId_1` INT, IN `n_StateId_1` INT, IN `t_Address1` VARCHAR(255), IN `modifiedBy` INT)
update `tbl_systemlogin` set firstName = p_firstName, lastName = p_lastName, n_CityId = n_CountryId_1, n_StateId = n_StateId_1,t_Address =t_Address1, n_modifiedby = modifiedBy, d_modifiedon = NOW() where a_SysloginId = id//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_viewbusadmin
DELIMITER //
CREATE  PROCEDURE `proc_viewbusadmin`(IN `busid` INT)
BEGIN
IF(busid='') THEN
SELECT * FROM tbl_businessadmin;

ELSE
SELECT * FROM tbl_businessadmin WHERE n_BusinessId=busid;

END IF;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_viewbusname
DELIMITER //
CREATE  PROCEDURE `proc_viewbusname`(IN `bid` INT , IN `bname` VARCHAR (255), IN `act_mode` VARCHAR (255))
BEGIN 

IF(`act_mode`='searchbusname') THEN

SELECT t_FirstName ,t_LastName 
FROM tbl_businessadmin
WHERE `t_FirstName` LIKE CONCAT('%',bname, '%')
AND `n_BusinessId` =bid;

END IF;

END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_viewcountry
DELIMITER //
CREATE  PROCEDURE `proc_viewcountry`(IN `bus_id` INT )
BEGIN 

SELECT a_CountryId , t_CountryName FROM tblcountry WHERE b_IsActive=1 AND n_BusinessId=bus_id; 

END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_ViewEmpData
DELIMITER //
CREATE  PROCEDURE `proc_ViewEmpData`(IN `e_Mode` VARCHAR(255), IN `e_EmpId` INT )
BEGIN
IF(e_Mode='select')THEN
SELECT * FROM tblemployeemaster WHERE a_EmpId=e_EmpId;
END IF;
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_ViewPolicy
DELIMITER //
CREATE  PROCEDURE `proc_ViewPolicy`(IN `act_mode` VARCHAR (100), IN `busid` INT )
BEGIN
if(act_mode='allview')THEN
SELECT * FROM tblpolicymaster WHERE b_Deleted=0 AND n_BusinessId=busid;
END IF;
if(act_mode='viewdep') THEN
SELECT * FROM tbldepartment WHERE b_Deleted=0 AND n_BusinessId=busid;
END IF;

if(act_mode='viewbill') THEN
if(busid='') THEN

SELECT * FROM tblsettingvalue WHERE b_IsActive=1 AND n_BusinessId=busid AND n_EnumId=5;
END IF;

ELSE IF(busid!='')THEN

SELECT * FROM tblsettingvalue WHERE b_IsActive=1 AND n_BusinessId=busid;

END IF;
END IF;
if(act_mode='viewpack') THEN

SELECT * FROM tblsettingvalue WHERE b_IsActive=1 AND n_BusinessId=busid AND n_EnumId=6;
END IF;

if(act_mode='viewdist') THEN

SELECT * FROM tblsettingvalue WHERE b_IsActive=1 AND n_BusinessId=busid AND n_EnumId=4;
END IF;


END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.proc_XmlInsert
DELIMITER //
CREATE  PROCEDURE `proc_XmlInsert`(IN p_TableName VARCHAR(200),
 IN p_XmlText longtext,
 IN p_ColumnName varchar(500),
 IN p_StaticValues varchar(500) )
BEGIN
DECLARE xml text;
DECLARE nrows INT;
DECLARE rownum INT DEFAULT 1;
DECLARE ncols INT;
DECLARE ins_list TEXT DEFAULT '';
DECLARE tmp VARCHAR(255);
DECLARE colnum INT DEFAULT 1;
DECLARE val_list TEXT DEFAULT '';
declare tblName varchar(50) default '';
declare ColumnName text default '';
declare staticLength int default 0; 
declare staticV varchar(500) default '';
#declare staticV1 varchar(500) default '';
declare count int default 0;
#<NewDataSet><tblBankBranchAccounts><n_BranchId>4</n_BranchId><n_AccountType>2</n_AccountType><t_AccountNumber></t_AccountNumber>452155412<t_accountHolderName>yofenv</t_accountHolderName><n_IbanNo>454215</n_IbanNo></tblBankBranchAccounts></NewDataSet> 


# set the Columns names to variable
#set ColumnName='n_BranchId,n_AccountType,t_AccountNumber,t_accountHolderName,n_IbanNo';
set xml=p_XmlText;
set ColumnName=p_ColumnName;
# get the table name

#set tblName = ExtractValue(xml,'//table_data/@name');
set tblName=p_TableName;
#select tblName;
# get the number of <row>s in this table
set nrows = ExtractValue(xml,'count(//NewDataSet/*)');
#select nrows;

 # get the number of <field>s (columns) in this table
SET ncols = ExtractValue(xml,'count(//NewDataSet/*/*)');
#SET ncols = ExtractValue(xml,'count(/mysqldump/database[@name=$database_name]/table_data[@name=$table_name]/row[1]/field)');
#select ncols;

# for each <row>
set staticLength=(SELECT LENGTH(p_StaticValues) - LENGTH(REPLACE(p_StaticValues, ',', '')));
set staticLength= staticLength;
#select count;
#select staticLength;
##select staticLength;
while count <= staticLength  DO
set count=count+1;
SET staticV = CONCAT(staticV, '''',SUBSTRING_INDEX(SUBSTRING_INDEX(p_StaticValues, ',', count), ',', -1),'''', IF(count <= staticLength, ',', ''));
#select staticV;
##set staticV1=concat(staticV1,staticV);
##select staticV1;
end while;
set staticV=concat(',',staticV);
#select staticV;
#SUBSTRING_INDEX(p_StaticValues, ',', staticLength) 

WHILE rownum <= nrows DO
# for each <field> (column)
    WHILE colnum <= ncols/nrows DO
     SET tmp= ExtractValue(xml,'//NewDataSet/*[$rownum]/*[$colnum]');
      #select tmp;
     # set the columns values
     #SET val_list = CONCAT(val_list, '''', tmp ,'''', IF(colnum<ncols, ',', ''));
     
     SET ins_list = CONCAT(ins_list, '''', tmp,'''', IF(colnum < ncols/nrows, ',', ''));
    #select ins_list;
    # SET val_list = CONCAT(val_list, '''', tmp ,'''', IF(colnum<ncols, ',', ''));
     SET colnum = colnum + 1;
     END WHILE;
     SET @ins_text = CONCAT('INSERT INTO ',tblName,' (', ColumnName, ') VALUES (',ins_list,staticV,')');
     #set @ins_text =concat(@ins_text,staticV);
     #select staticV;
   --  select @ins_text; 
	 SET ins_list = '';
     
     PREPARE stmt FROM @ins_text;
	 EXECUTE stmt;
     #SET val_list = '';
          #select ins_list;
          #select ColumnName;
          #select @ins_text;   
          SET rownum = rownum + 1;
    SET colnum = 1; 
    END WHILE; 
     
END//
DELIMITER ;


-- Dumping structure for procedure trueexpence.pro_checkadminemail
DELIMITER //
CREATE  PROCEDURE `pro_checkadminemail`(IN `pEmail` varchar(255) )
begin
	select count(*) as myworkdone  from `tbl_systemlogin` where t_username = pEmail and IsActive !='Delete';
end//
DELIMITER ;


-- Dumping structure for procedure trueexpence.Pro_EditViewCity
DELIMITER //
CREATE  PROCEDURE `Pro_EditViewCity`(IN `p_mode` varchar(20), IN `p_id` INT, IN `p_stateId` INT, IN `p_BusinessId` INT, IN `p_admin` INT)
BEGIN
if(`p_BusinessId`='')
then
if(`p_mode`='Select')
then
select t_CountryName,a_CityId,t_StateName,t_CityName
from tblcountry TC
inner join tblstate TS on TC.a_CountryId=TS.n_CountryId
inner join tblcity  on TS.a_StateId=tblcity.n_StateId where tblcity.n_AdminType=p_admin;
end if;
if(`p_mode` = 'Editselect')
then
select tblcity.*,tblstate.n_CountryId  from tblcity left join tblstate on tblcity.n_StateId=tblstate.a_StateId where tblcity.a_CityId=p_id and tblcity.n_AdminType=p_admin; 
end if;
if(`p_mode` = 'CitySelect')
then
select a_CityId,t_CityName from tblcity where n_StateId=p_stateId and n_AdminType=p_admin; 
end if;
else
if(`p_mode`='Select')
then
select t_CountryName,a_CityId,t_StateName,t_CityName
from tblcountry TC
inner join tblstate TS on TC.a_CountryId=TS.n_CountryId
inner join tblcity  on TS.a_StateId=tblcity.n_StateId where b_Deleted=0 and tblcity.n_BusinessId=p_BusinessId;
end if;
if(`p_mode` = 'Editselect')
then
select tblcity.*,tblstate.n_CountryId  from tblcity left join tblstate on tblcity.n_StateId=tblstate.a_StateId where tblcity.a_CityId=p_id and  tblcity.n_BusinessId=p_BusinessId; 
end if;
if(`p_mode` = 'CitySelect')
then
select a_CityId,t_CityName from tblcity where n_StateId=p_stateId ;
end if;
end if;
END//
DELIMITER ;


-- Dumping structure for table trueexpence.tblbillinginfo
CREATE TABLE IF NOT EXISTS `tblbillinginfo` (
  `a_BillId` int(254) NOT NULL AUTO_INCREMENT,
  `n_BillTypeId` int(100) NOT NULL,
  `t_Contact` varchar(20) DEFAULT NULL,
  `t_Email` varchar(100) DEFAULT NULL,
  `n_PackId` int(100) NOT NULL,
  `n_CountyId` int(100) DEFAULT NULL,
  `n_CityId` int(100) DEFAULT NULL,
  `n_StateId` int(100) DEFAULT NULL,
  `t_Address` varchar(100) DEFAULT NULL,
  `n_BusnAdminId` bigint(100) DEFAULT NULL,
  `n_BusinessId` bigint(100) DEFAULT NULL,
  `d_CreatedOn` bigint(254) NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  PRIMARY KEY (`a_BillId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblbillinginfo: 0 rows
/*!40000 ALTER TABLE `tblbillinginfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblbillinginfo` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblbnscustagmap
CREATE TABLE IF NOT EXISTS `tblbnscustagmap` (
  `a_BnsTagMapId` int(254) NOT NULL AUTO_INCREMENT,
  `n_BusinessSetID` int(100) DEFAULT NULL,
  `n_CustTagId` bigint(100) DEFAULT NULL,
  `b_Deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`a_BnsTagMapId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblbnscustagmap: 0 rows
/*!40000 ALTER TABLE `tblbnscustagmap` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblbnscustagmap` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblbusiness
CREATE TABLE IF NOT EXISTS `tblbusiness` (
  `a_BusinessId` int(11) NOT NULL AUTO_INCREMENT,
  `t_BusinessCode` varchar(50) NOT NULL,
  `t_BusinessName` varchar(100) NOT NULL,
  `n_CountryId` varchar(50) DEFAULT NULL,
  `n_StateId` int(11) DEFAULT NULL,
  `n_City` int(11) DEFAULT NULL,
  `t_Address` varchar(300) DEFAULT NULL,
  `n_Status` int(11) NOT NULL,
  `d_StartDate` datetime DEFAULT NULL,
  `d_EndDate` datetime DEFAULT NULL,
  `n_UserCount` int(11) DEFAULT NULL,
  `n_CurrencyId` int(11) DEFAULT NULL,
  `b_ExpOtherCtry` bit(1) DEFAULT NULL,
  `t_DateFormat` varchar(20) DEFAULT NULL,
  `n_AdminID` bigint(100) NOT NULL,
  `n_BillingType` int(11) NOT NULL,
  `t_Billingname` varchar(100) DEFAULT NULL,
  `t_BillingEmailAdd` varchar(255) DEFAULT NULL,
  `n_Package` int(100) NOT NULL,
  `n_Distance` int(100) DEFAULT NULL,
  `d_CreatedOn` bigint(254) NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  `b_Deleted` smallint(2) DEFAULT NULL,
  `bill_cont_id` int(10) DEFAULT NULL,
  `bill_state_id` int(10) DEFAULT NULL,
  `bill_city_id` int(10) NOT NULL,
  `t_AddfLine` varchar(150) DEFAULT NULL,
  `t_AddSecLine` varchar(150) DEFAULT NULL,
  `bill_contact` bigint(20) NOT NULL,
  `n_reimb` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`a_BusinessId`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblbusiness: 23 rows
/*!40000 ALTER TABLE `tblbusiness` DISABLE KEYS */;
INSERT INTO `tblbusiness` (`a_BusinessId`, `t_BusinessCode`, `t_BusinessName`, `n_CountryId`, `n_StateId`, `n_City`, `t_Address`, `n_Status`, `d_StartDate`, `d_EndDate`, `n_UserCount`, `n_CurrencyId`, `b_ExpOtherCtry`, `t_DateFormat`, `n_AdminID`, `n_BillingType`, `t_Billingname`, `t_BillingEmailAdd`, `n_Package`, `n_Distance`, `d_CreatedOn`, `n_CreatedBy`, `d_ModifiedOn`, `n_ModifiedBy`, `b_Deleted`, `bill_cont_id`, `bill_state_id`, `bill_city_id`, `t_AddfLine`, `t_AddSecLine`, `bill_contact`, `n_reimb`) VALUES
	(1, 'p_Busineescode', 'Mindz technology', '1', 1, 1, 'this is address%this is address', 2, '2014-11-13 00:00:00', '2014-11-30 00:00:00', 100, 1, b'1', 'DMY', 1, 1, '1', 'deepesh@mindztechnology.com', 1, 1, 2014, 1, '2014-11-20 17:00:38', 0, 0, 1, 1, 1, 'Address Line1', 'Adress', 0, 1),
	(2, 'p_Busineescode', 'Mindz technology1', '1', 1, 1, 'dfg asdfafasdf%Address Line2', 2, '2014-11-24 00:00:00', '2014-11-30 00:00:00', 22, 1, b'1', 'YMD', 1, 2, '2', 'billingInformation@gmail.com', 1, 1, 2014, 1, '2014-11-21 14:19:23', 0, 2, 1, 1, 3, 'dfg sdfa sadf asfs', 'bAddress Line12', 0, 1),
	(5, 'p_Busineescode', 'Mindz technology2', '1', 1, 1, 'dfg asdfafasdf%Address Line2', 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1, b'1', '0', 1, 1, '2', 'billingInformation@gmail.com', 1, 1, 2014, 1, '2014-11-21 14:19:30', 0, 2, 0, 0, 0, '0', '0', 0, NULL),
	(6, 'p_Busineescode', 'Business Name1', '1', 1, 1, 'Address Line1%Address Line2', 1, '2014-11-25 00:00:00', '2014-11-25 00:00:00', 12, 1, b'1', 'DMY', 1, 2, '2', 'bulling@gmail.com', 1, 1, 2014, 1, '2014-11-21 14:19:39', 0, 2, 1, 1, 1, 'bulladdress1', 'bAddress Line2', 0, NULL),
	(7, 'p_Busineescode', 'Business Name2', '1', 1, 1, 'Address Line1%Address Line2', 1, '2014-11-25 00:00:00', '2014-11-25 00:00:00', 12, 1, b'1', 'DMY', 1, 2, '2', 'bulling@gmail.com', 1, 1, 2014, 1, '2014-11-21 14:19:44', 0, 2, 1, 1, 1, 'bulladdress1', 'bAddress Line2', 0, NULL),
	(8, 'p_Busineescode', 'Business Name3', '1', 1, 1, 'Address Line1%Address Line2', 1, '2014-11-25 00:00:00', '2014-11-25 00:00:00', 12, 1, b'1', 'DMY', 1, 2, '2', 'bulling@gmail.com', 1, 1, 2014, 1, '2014-11-21 14:19:49', 0, 2, 1, 1, 1, 'bulladdress1', 'bAddress Line2', 0, NULL),
	(9, 'p_Busineescode', 'Business Name', '1', 1, 1, 'address%address', 1, '2014-11-19 00:00:00', '2014-11-19 00:00:00', 111, 1, b'1', 'MDY', 1, 1, '1', 'deepesh@mindz.com', 1, 1, 2014, 1, '2014-11-21 14:19:55', 1, 2, 1, 1, 1, 'address', 'address', 0, NULL),
	(10, 'p_Busineescode', 'Business Name', '2', 2, 2, 'Address Line21%Address Line2', 1, '2014-11-30 00:00:00', '2014-11-28 00:00:00', 1111222, 1, b'1', 'DMY', 1, 3, '3', 'sheetesh@india.com1', 4, 1, 2014, 1, '2014-11-21 14:19:59', 1, 2, 5, 0, 0, 'SAGAR PUR133g1', 'MOHAN NAGR133g1', 4561, NULL),
	(11, 'p_Busineescode', 'business new11', '2', 2, 2, 'Address Line11%Address Line21', 1, '2014-11-30 00:00:00', '2014-11-28 00:00:00', 123, 1, b'1', 'DMY', 1, 3, '3', 'fsf@dsdf.com1', 4, 1, 2014, 1, '2014-11-21 14:20:04', 1, 2, 2, 2, 4, 'sssas1', 'ghghdsas1', 333322164564564561, NULL),
	(12, 'p_Busineescode', 'True Expense Test', '1', 1, 1, 'test1%test1', 2, '2014-11-30 00:00:00', '2014-11-26 00:00:00', 10, 1, b'1', 'DMY', 1, 1, '1', 'testuser@gmail.com', 1, 1, 2014, 1, '2014-11-21 14:20:08', 1, 2, 1, 1, 1, 'test1', 'test1', 4444, NULL),
	(13, 'p_Busineescode', 'dsfds dgsf', '1', 1, 1, 'fdgdfgdf%fdgdfgdf', 2, '2014-11-29 00:00:00', '2014-11-28 00:00:00', 55, 1, b'1', 'DMY', 1, 2, '2', 'bulling@gmail.com', 4, 1, 2014, 1, '2014-11-21 15:36:02', 1, 1, 1, 1, 1, 'ertertert', 'ertrterert', 45645645645, NULL),
	(14, 'p_Busineescode', 'dfgdfgdfgsdfgdfg19', '1', 1, 1, 'dfg dfgdfg dfgdf%dfgdfgdsfgdg', 1, '2014-11-30 00:00:00', '2014-11-28 00:00:00', 534, 1, b'1', 'DMY', 1, 1, '1', 'billingInformation@gmail.com', 3, 1, 2014, 2, '2014-11-21 15:35:57', 1, 1, 1, 1, 1, '234234324', '23432df dsfsdfss', 45435345, NULL),
	(15, 'p_Busineescode', 'sdfsdfsdsdf', '1', 1, 1, 'sdfsdfsdfs%sdfsdfsdfs', 2, '2014-11-29 00:00:00', '2014-11-30 00:00:00', 5345435, 1, b'1', 'YMD', 1, 1, '1', 'billingInformation@gmail.com', 1, 3, 2014, 2, '2014-11-21 15:35:50', 0, 1, 1, 1, 1, 'dfg sdfa sadf asfs', 'sdfasdfasfasdf', 345, NULL),
	(16, 'p_Busineescode', 'Business Nameefsd', '1', 1, 1, 'dfg asdfafasdf%bAddress Line12', 2, '2014-11-27 00:00:00', '2014-11-29 00:00:00', 5345435, 1, b'1', 'DMY', 1, 2, '2', 'billingInformation@gmail.com', 1, 1, 2014, 2, '2014-11-21 14:19:08', 1, 2, 1, 1, 1, 'tyrtytrytryrtyrtyrty', 'tryrtyrtyrtyryryryryrty', 436456456, NULL),
	(17, 'p_Busineescode', 'Business Name', '1', 1, 1, 'dfg asdfafasdf%bAddress Line12', 2, '2014-11-27 00:00:00', '2014-11-29 00:00:00', 5345435, 1, b'1', 'DMY', 1, 2, '2', 'billingInformation@gmail.com', 1, 1, 2014, 2, '2014-11-21 14:19:04', 1, 2, 2, 2, 2, 'tyrtytrytryrtyrtyrty', 'tryrtyrtyrtyryryryryrty', 436456456, NULL),
	(18, 'p_Busineescode', 'Business Name', '1', 1, 1, 'dfg asdfafasdf%bAddress Line12', 1, '2014-11-27 00:00:00', '2014-11-29 00:00:00', 5345435, 1, b'1', 'DMY', 1, 2, '2', 'billingInformation@gmail.com', 1, 1, 2014, 2, '2014-11-20 17:29:39', 1, 2, 1, 1, 1, 'tyrtytrytryrtyrtyrty', 'tryrtyrtyrtyryryryryrty', 436456456, NULL),
	(19, 'p_Busineescode', 'Apple Computers', '1', 1, 1, 'Address%Address', 1, '2014-11-19 00:00:00', '2014-11-19 00:00:00', 100, 1, b'1', 'DMY', 1, 3, '3', 'google@gmail.com', 4, 1, 2014, 1, '2014-11-20 17:29:37', 1, 2, 1, 1, 1, 'Address Line11', 'Address Line11', 999067303, NULL),
	(20, 'p_Busineescode', 'asdasdasdas', '1', 1, 1, 'bAddress Line1%bAddress Line12', 1, '2014-11-29 00:00:00', '2014-11-29 00:00:00', 34543, 1, b'1', 'DMY', 1, 1, '1', 'billingInformation@gmail.com', 1, 1, 2014, 2, '2014-11-21 15:35:43', 1, 1, 1, 1, 1, 'dfg sdfa sadf asfs', 'bAddress Line12', 9999999999, NULL),
	(21, 'p_Busineescode', 'Deepesh company', '1', 1, 1, 'this is address%this is another address', 1, '2014-11-19 00:00:00', '2014-11-26 00:00:00', 100, 1, b'1', 'DMY', 1, 1, '1', 'wd.deepesh@gmail.com', 1, 2, 2014, 1, '2014-11-20 17:29:27', 0, 2, 1, 1, 1, 'Address Line1', 'Address Line1', 999067303, NULL),
	(22, 'p_Busineescode', 'creative professionals india', '1', 1, 1, 'address 22%address 22', 1, '2014-11-20 00:00:00', '2014-11-27 00:00:00', 12312, 1, b'1', 'DMY', 1, 1, '1', 'creative@gmail.com', 3, 1, 2014, 1, '2014-11-20 17:29:25', 1, 2, 1, 1, 1, 'Address Line33', 'Address Line33', 9990617303, NULL),
	(23, 'p_Busineescode', 'Jivo lol', '1', 1, 1, 'this is the address%this is the address', 1, '2014-11-21 00:00:00', '2014-11-30 00:00:00', 122, 1, b'1', 'DMY', 1, 1, '1', 'jivo@gmail.com', 1, 2, 2014, 1, '0000-00-00 00:00:00', 0, 0, 1, 1, 1, 'address and testing', 'this is the address', 9990617303, 1),
	(24, 'p_Busineescode', 'Paintball Company Ltd.', '1', 6, 5, 'Udyog Vihar%Phase 1', 2, '2014-11-21 00:00:00', '2014-12-31 00:00:00', 20, 1, b'1', 'DMY', 1, 42, '42', 'admin@paintball.com', 44, 1, 2014, 1, '2014-11-21 16:12:36', 1, 0, 1, 6, 5, 'Udyog Vihar', 'phase 1', 1234567890, NULL),
	(25, 'p_Busineescode', 'Google', '1', 5, 3, 'asldkfj%lkasjfd', 1, '2014-11-21 00:00:00', '2014-11-26 00:00:00', 123, 1, b'1', 'DMY', 1, 1, '1', 'google@gmail.com', 1, 3, 2014, 1, '0000-00-00 00:00:00', 0, 0, 1, 5, 3, 'asdfasdf', 'asdfasdf', 9990617303, NULL);
/*!40000 ALTER TABLE `tblbusiness` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblbusinesscatmap
CREATE TABLE IF NOT EXISTS `tblbusinesscatmap` (
  `a_BnsCatId` int(254) NOT NULL AUTO_INCREMENT,
  `n_BusinessSetID` bigint(100) DEFAULT NULL,
  `n_SpndngCatId` int(100) DEFAULT NULL,
  `d_CreatedOn` bigint(254) NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  PRIMARY KEY (`a_BnsCatId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblbusinesscatmap: 0 rows
/*!40000 ALTER TABLE `tblbusinesscatmap` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblbusinesscatmap` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblbusinessdeptmap
CREATE TABLE IF NOT EXISTS `tblbusinessdeptmap` (
  `a_BnsDepMapId` int(254) NOT NULL AUTO_INCREMENT,
  `n_BusinessSetID` bigint(11) DEFAULT NULL,
  `n_DeptId` int(11) DEFAULT NULL,
  `d_CreatedOn` bigint(254) NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  PRIMARY KEY (`a_BnsDepMapId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblbusinessdeptmap: 0 rows
/*!40000 ALTER TABLE `tblbusinessdeptmap` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblbusinessdeptmap` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblbusinesssetting
CREATE TABLE IF NOT EXISTS `tblbusinesssetting` (
  `a_BusinessSetID` int(254) NOT NULL AUTO_INCREMENT,
  `n_BnsId` bigint(100) DEFAULT NULL,
  `n_Reimbursement` int(11) NOT NULL,
  `d_CreatedOn` bigint(254) NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  `b_Deleted` bit(1) DEFAULT NULL,
  `n_BusinessId` int(11) DEFAULT NULL,
  `n_AdminType` int(11) DEFAULT NULL,
  PRIMARY KEY (`a_BusinessSetID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblbusinesssetting: 0 rows
/*!40000 ALTER TABLE `tblbusinesssetting` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblbusinesssetting` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblcity
CREATE TABLE IF NOT EXISTS `tblcity` (
  `a_CityId` int(254) NOT NULL AUTO_INCREMENT,
  `n_StateId` int(11) DEFAULT NULL,
  `t_CityName` varchar(100) NOT NULL,
  `d_CreatedOn` bigint(254) NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  `b_Deleted` bit(1) DEFAULT NULL,
  `n_AdminType` int(11) NOT NULL,
  `n_BusinessId` int(11) NOT NULL,
  PRIMARY KEY (`a_CityId`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblcity: 5 rows
/*!40000 ALTER TABLE `tblcity` DISABLE KEYS */;
INSERT INTO `tblcity` (`a_CityId`, `n_StateId`, `t_CityName`, `d_CreatedOn`, `n_CreatedBy`, `d_ModifiedOn`, `n_ModifiedBy`, `b_Deleted`, `n_AdminType`, `n_BusinessId`) VALUES
	(1, 1, 'vikash puri', 2014, 0, '0000-00-00 00:00:00', 0, b'1', 33, 0),
	(2, 3, 'navada city', 2014, 0, '0000-00-00 00:00:00', 0, b'1', 33, 0),
	(3, 5, 'Delhi', 2014, 0, '0000-00-00 00:00:00', 0, b'1', 33, 0),
	(4, 2, 'Mumbai', 2014, 0, '0000-00-00 00:00:00', 0, b'1', 33, 0),
	(5, 6, 'Gurgaon', 2014, 0, '0000-00-00 00:00:00', 0, b'1', 33, 0);
/*!40000 ALTER TABLE `tblcity` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblcountry
CREATE TABLE IF NOT EXISTS `tblcountry` (
  `a_CountryId` int(254) NOT NULL AUTO_INCREMENT,
  `t_CountryName` varchar(50) NOT NULL,
  `d_CreatedOn` datetime NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  `b_IsActive` bit(1) NOT NULL,
  `n_BusinessId` int(254) NOT NULL,
  `n_AdminType` int(254) NOT NULL,
  PRIMARY KEY (`a_CountryId`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblcountry: 3 rows
/*!40000 ALTER TABLE `tblcountry` DISABLE KEYS */;
INSERT INTO `tblcountry` (`a_CountryId`, `t_CountryName`, `d_CreatedOn`, `n_CreatedBy`, `d_ModifiedOn`, `n_ModifiedBy`, `b_IsActive`, `n_BusinessId`, `n_AdminType`) VALUES
	(1, 'India', '2014-11-21 01:46:51', 0, '2014-11-21 11:01:08', 0, b'1', 0, 33),
	(4, 'USA', '2014-11-21 11:03:27', 0, '0000-00-00 00:00:00', 0, b'1', 0, 33),
	(5, 'Germany', '2014-11-21 11:03:36', 0, '0000-00-00 00:00:00', 0, b'1', 0, 33);
/*!40000 ALTER TABLE `tblcountry` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblcurrency
CREATE TABLE IF NOT EXISTS `tblcurrency` (
  `a_CurrencyId` int(254) NOT NULL AUTO_INCREMENT,
  `n_CountryId` int(11) NOT NULL,
  `t_CurrencyName` varchar(50) NOT NULL,
  `d_CreatedOn` datetime NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  `b_IsActive` bit(1) DEFAULT NULL,
  `n_BusinessId` int(254) NOT NULL,
  `n_AdminType` int(254) NOT NULL,
  PRIMARY KEY (`a_CurrencyId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblcurrency: ~3 rows (approximately)
/*!40000 ALTER TABLE `tblcurrency` DISABLE KEYS */;
INSERT INTO `tblcurrency` (`a_CurrencyId`, `n_CountryId`, `t_CurrencyName`, `d_CreatedOn`, `n_CreatedBy`, `d_ModifiedOn`, `n_ModifiedBy`, `b_IsActive`, `n_BusinessId`, `n_AdminType`) VALUES
	(6, 1, 'INR', '2014-11-18 12:35:00', 0, '2014-11-18 12:40:23', 0, b'1', 0, 33),
	(7, 4, '$', '2014-11-18 12:37:04', 0, '2014-11-21 11:03:59', 0, b'1', 0, 33),
	(9, 5, '€', '2014-11-18 12:38:28', 0, '2014-11-21 11:03:50', 0, b'1', 0, 33);
/*!40000 ALTER TABLE `tblcurrency` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblcustomcategory
CREATE TABLE IF NOT EXISTS `tblcustomcategory` (
  `a_CustCatId` bigint(20) NOT NULL AUTO_INCREMENT,
  `t_CustCatName` varchar(100) DEFAULT NULL,
  `n_CreatedBy` int(11) DEFAULT NULL,
  `d_CreatedOn` datetime DEFAULT NULL,
  `n_ModifiedBy` int(11) DEFAULT NULL,
  `d_ModifiedOn` datetime DEFAULT NULL,
  `n_BusinessId` int(11) DEFAULT NULL,
  `b_Deleted` bit(1) DEFAULT b'0',
  `n_AdminType` int(11) DEFAULT NULL,
  PRIMARY KEY (`a_CustCatId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblcustomcategory: ~1 rows (approximately)
/*!40000 ALTER TABLE `tblcustomcategory` DISABLE KEYS */;
INSERT INTO `tblcustomcategory` (`a_CustCatId`, `t_CustCatName`, `n_CreatedBy`, `d_CreatedOn`, `n_ModifiedBy`, `d_ModifiedOn`, `n_BusinessId`, `b_Deleted`, `n_AdminType`) VALUES
	(1, 'www', 1, '2014-10-17 18:36:55', NULL, NULL, 1, b'0', 1);
/*!40000 ALTER TABLE `tblcustomcategory` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblcustomtag
CREATE TABLE IF NOT EXISTS `tblcustomtag` (
  `a_CustTagId` int(254) NOT NULL AUTO_INCREMENT,
  `t_CustText` varchar(50) DEFAULT NULL,
  `t_CustValue` varchar(10) NOT NULL,
  `n_CustCatId` int(11) NOT NULL,
  `d_CreatedOn` bigint(254) NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  `b_Deleted` bit(1) NOT NULL,
  `n_BusinessId` int(254) NOT NULL,
  `n_AdminType` int(254) NOT NULL,
  PRIMARY KEY (`a_CustTagId`),
  UNIQUE KEY `t_CustText` (`t_CustText`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblcustomtag: 26 rows
/*!40000 ALTER TABLE `tblcustomtag` DISABLE KEYS */;
INSERT INTO `tblcustomtag` (`a_CustTagId`, `t_CustText`, `t_CustValue`, `n_CustCatId`, `d_CreatedOn`, `n_CreatedBy`, `d_ModifiedOn`, `n_ModifiedBy`, `b_Deleted`, `n_BusinessId`, `n_AdminType`) VALUES
	(1, '', '', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 2, 1),
	(2, 'fdgdfgd', '3453534', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 2, 1),
	(3, 'fdgdgd', '435354', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 2, 1),
	(4, 'dfgdfgdfg', '345435435', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 2, 1),
	(5, 'dfgdfgd', '435435', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 2, 1),
	(6, 'ftgdgdf', '4353453454', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 2, 1),
	(7, 'sdda', '111111', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 2, 1),
	(8, 'gfdg', 'gdfg', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 2, 1),
	(9, 'dfdfgfg', 'dgfdgf', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 2, 1),
	(10, 'fdsfsd', 'fdsf', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 2, 1),
	(11, 'dc', 'dc', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 2, 1),
	(12, 'fsdf', 'dfsf', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 2, 1),
	(13, 'dads', 'zxad', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 1, 1),
	(14, 'werwe', '34534', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 1, 1),
	(15, 'wrer', '454', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 1, 1),
	(16, 'werwerwer', '55', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 1, 1),
	(17, 'ddgd', 'dfgdg', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 2, 1),
	(18, 'fghf', 'fghf', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 1, 1),
	(19, 'g', 'ghghg', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 1, 1),
	(20, 'gggg', 'ghg', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 1, 1),
	(21, 'c', 'c', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 1, 1),
	(22, 'cvx', 'cxc', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 1, 1),
	(23, 'cars', 'cars', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 23, 1),
	(24, 'trucks', 'trucks', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 23, 1),
	(25, 'moter cycle', 'motercycle', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 23, 1),
	(26, 'ertyeryt', 'okay ', 0, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 23, 1);
/*!40000 ALTER TABLE `tblcustomtag` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tbldepartment
CREATE TABLE IF NOT EXISTS `tbldepartment` (
  `a_DeptId` int(254) NOT NULL AUTO_INCREMENT,
  `t_DeptCode` varchar(50) NOT NULL,
  `t_DeptName` varchar(50) DEFAULT NULL,
  `d_CreatedOn` datetime NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  `b_IsActive` bit(1) NOT NULL,
  `b_Deleted` bit(1) NOT NULL,
  `n_BusinessId` int(254) NOT NULL,
  `n_AdminType` int(254) NOT NULL,
  PRIMARY KEY (`a_DeptId`),
  UNIQUE KEY `t_DeptName` (`t_DeptName`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tbldepartment: 14 rows
/*!40000 ALTER TABLE `tbldepartment` DISABLE KEYS */;
INSERT INTO `tbldepartment` (`a_DeptId`, `t_DeptCode`, `t_DeptName`, `d_CreatedOn`, `n_CreatedBy`, `d_ModifiedOn`, `n_ModifiedBy`, `b_IsActive`, `b_Deleted`, `n_BusinessId`, `n_AdminType`) VALUES
	(1, '', 'abc', '2014-11-14 17:09:24', 1, '0000-00-00 00:00:00', 0, b'0', b'1', 2, 1),
	(3, '', 'cc', '2014-11-14 17:13:29', 1, '0000-00-00 00:00:00', 0, b'0', b'1', 2, 1),
	(4, '', 'erwe', '2014-11-14 18:30:41', 1, '0000-00-00 00:00:00', 0, b'0', b'1', 1, 1),
	(5, '', 'fdd', '2014-11-14 18:30:41', 1, '0000-00-00 00:00:00', 0, b'0', b'1', 1, 1),
	(6, '', 'dff', '2014-11-14 18:30:41', 1, '0000-00-00 00:00:00', 0, b'0', b'1', 1, 1),
	(7, '', 'f', '2014-11-14 18:30:41', 1, '0000-00-00 00:00:00', 0, b'0', b'1', 1, 1),
	(8, '', 'ggdf', '2014-11-14 18:41:29', 1, '0000-00-00 00:00:00', 0, b'0', b'1', 2, 1),
	(9, '', 'dsdsd', '2014-11-14 18:41:40', 1, '0000-00-00 00:00:00', 0, b'0', b'1', 2, 1),
	(10, '', 'dgdfg', '2014-11-14 20:20:22', 1, '0000-00-00 00:00:00', 0, b'0', b'1', 1, 1),
	(11, '', 'developement', '2014-11-20 19:29:03', 1, '0000-00-00 00:00:00', 0, b'0', b'1', 22, 1),
	(12, '', 'qq', '2014-11-20 20:18:08', 1, '0000-00-00 00:00:00', 0, b'0', b'1', 2, 1),
	(13, '', 'deepesh', '2014-11-20 20:28:47', 1, '0000-00-00 00:00:00', 0, b'0', b'0', 1, 1),
	(14, '', 'jivo department', '2014-11-21 16:24:51', 1, '0000-00-00 00:00:00', 0, b'0', b'1', 23, 1),
	(15, '', 'jivo developement', '2014-11-21 16:24:51', 1, '0000-00-00 00:00:00', 0, b'0', b'1', 23, 1);
/*!40000 ALTER TABLE `tbldepartment` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblempaccessmap
CREATE TABLE IF NOT EXISTS `tblempaccessmap` (
  `a_EmpAccessMapId` int(254) NOT NULL AUTO_INCREMENT,
  `n_RoleAccessId` int(11) DEFAULT NULL,
  `n_EmpId` bigint(100) DEFAULT NULL,
  `n_AmtRange` decimal(15,3) DEFAULT NULL,
  `t_CompareValue` varchar(10) DEFAULT NULL,
  `d_CreatedOn` datetime NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  `b_Deleted` bit(1) DEFAULT b'0',
  `n_BusinessId` int(11) DEFAULT NULL,
  PRIMARY KEY (`a_EmpAccessMapId`)
) ENGINE=MyISAM AUTO_INCREMENT=224 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblempaccessmap: 103 rows
/*!40000 ALTER TABLE `tblempaccessmap` DISABLE KEYS */;
INSERT INTO `tblempaccessmap` (`a_EmpAccessMapId`, `n_RoleAccessId`, `n_EmpId`, `n_AmtRange`, `t_CompareValue`, `d_CreatedOn`, `n_CreatedBy`, `d_ModifiedOn`, `n_ModifiedBy`, `b_Deleted`, `n_BusinessId`) VALUES
	(89, 5, 32, 100.000, '0.00', '2014-11-11 18:34:29', 0, '0000-00-00 00:00:00', 0, b'0', 23),
	(88, 3, 32, 100.000, '0.00', '2014-11-11 18:34:29', 0, '0000-00-00 00:00:00', 0, b'0', 23),
	(87, 1, 32, 100.000, '0.00', '2014-11-11 18:34:29', 0, '0000-00-00 00:00:00', 0, b'0', 23),
	(86, 5, 31, 100.000, '0.00', '2014-11-11 18:31:55', 0, '0000-00-00 00:00:00', 0, b'0', 22),
	(85, 3, 31, 100.000, '0.00', '2014-11-11 18:31:55', 0, '0000-00-00 00:00:00', 0, b'0', 22),
	(84, 1, 31, 100.000, '0.00', '2014-11-11 18:31:55', 0, '0000-00-00 00:00:00', 0, b'0', 22),
	(112, 5, 3, 121.000, '0.00', '2014-11-14 11:20:30', 0, '0000-00-00 00:00:00', 0, b'0', 1),
	(79, 3, 40, 12.000, 'null', '2014-11-07 19:05:34', 0, '0000-00-00 00:00:00', 0, b'0', 22),
	(111, 4, 3, 121.000, '0.00', '2014-11-14 11:20:30', 0, '0000-00-00 00:00:00', 0, b'0', 1),
	(74, 3, 34, 10.000, 'null', '2014-11-07 17:48:29', 0, '0000-00-00 00:00:00', 0, b'0', 22),
	(73, 1, 34, 10.000, 'null', '2014-11-07 17:48:29', 0, '0000-00-00 00:00:00', 0, b'0', 22),
	(167, 5, 15, 100.000, NULL, '0000-00-00 00:00:00', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(166, 4, 15, 100.000, NULL, '0000-00-00 00:00:00', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(165, 2, 15, 100.000, NULL, '0000-00-00 00:00:00', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(15, 1, 16, 52.000, '78', '2014-11-06 20:45:57', -1, '0000-00-00 00:00:00', 0, b'0', 22),
	(16, 3, 16, 52.000, '78', '2014-11-06 20:45:57', -1, '0000-00-00 00:00:00', 0, b'0', 22),
	(17, 5, 16, 52.000, '78', '2014-11-06 20:45:57', -1, '0000-00-00 00:00:00', 0, b'0', 22),
	(18, 1, 20, 52.000, '78', '2014-11-06 21:00:44', -1, '0000-00-00 00:00:00', 0, b'0', 22),
	(19, 3, 20, 52.000, '78', '2014-11-06 21:00:44', -1, '0000-00-00 00:00:00', 0, b'0', 22),
	(20, 5, 20, 52.000, '78', '2014-11-06 21:00:44', -1, '0000-00-00 00:00:00', 0, b'0', 22),
	(21, 2, 10, 52.000, '78', '2014-11-07 09:59:35', -1, '0000-00-00 00:00:00', 0, b'0', 22),
	(22, 4, 10, 52.000, '78', '2014-11-07 09:59:35', -1, '0000-00-00 00:00:00', 0, b'0', 22),
	(23, 6, 10, 52.000, '78', '2014-11-07 09:59:35', -1, '0000-00-00 00:00:00', 0, b'0', 22),
	(24, 2, 27, 52.000, '78', '2014-11-07 10:06:42', -1, '0000-00-00 00:00:00', 0, b'0', 22),
	(25, 4, 27, 52.000, '78', '2014-11-07 10:06:42', -1, '0000-00-00 00:00:00', 0, b'0', 22),
	(26, 6, 27, 52.000, '78', '2014-11-07 10:06:42', -1, '0000-00-00 00:00:00', 0, b'0', 22),
	(27, 2, 28, 52.000, '78', '2014-11-07 10:07:23', -1, '0000-00-00 00:00:00', 0, b'0', 22),
	(28, 4, 28, 52.000, '78', '2014-11-07 10:07:23', -1, '0000-00-00 00:00:00', 0, b'0', 22),
	(29, 6, 28, 52.000, '78', '2014-11-07 10:07:23', -1, '0000-00-00 00:00:00', 0, b'0', 22),
	(30, 2, 29, 100.000, '5', '2014-11-07 10:15:05', -1, '0000-00-00 00:00:00', 0, b'0', 22),
	(31, 4, 29, 100.000, '5', '2014-11-07 10:15:05', -1, '0000-00-00 00:00:00', 0, b'0', 22),
	(32, 6, 29, 100.000, '5', '2014-11-07 10:15:05', -1, '0000-00-00 00:00:00', 0, b'0', 22),
	(33, 2, 30, 100.000, 'null', '2014-11-07 10:16:44', 0, '0000-00-00 00:00:00', 0, b'0', 22),
	(34, 4, 30, 100.000, 'null', '2014-11-07 10:16:44', 0, '0000-00-00 00:00:00', 0, b'0', 22),
	(35, 6, 30, 100.000, 'null', '2014-11-07 10:16:44', 0, '0000-00-00 00:00:00', 0, b'0', 22),
	(36, 2, 31, 100.000, 'null', '2014-11-07 10:20:28', 0, '0000-00-00 00:00:00', 0, b'0', 22),
	(37, 4, 31, 100.000, 'null', '2014-11-07 10:20:28', 0, '0000-00-00 00:00:00', 0, b'0', 22),
	(38, 6, 31, 100.000, 'null', '2014-11-07 10:20:28', 0, '0000-00-00 00:00:00', 0, b'0', 22),
	(39, 1, 32, 1000.000, 'null', '2014-11-07 11:03:06', 0, '0000-00-00 00:00:00', 0, b'0', 22),
	(40, 3, 32, 1000.000, 'null', '2014-11-07 11:03:06', 0, '0000-00-00 00:00:00', 0, b'0', 22),
	(41, 4, 32, 1000.000, 'null', '2014-11-07 11:03:06', 0, '0000-00-00 00:00:00', 0, b'0', 22),
	(42, 5, 32, 1000.000, 'null', '2014-11-07 11:03:06', 0, '0000-00-00 00:00:00', 0, b'0', 22),
	(43, 7, 32, 1000.000, 'null', '2014-11-07 11:03:06', 0, '0000-00-00 00:00:00', 0, b'0', 22),
	(52, 4, 33, 10.000, 'null', '2014-11-07 17:05:54', 0, '0000-00-00 00:00:00', 0, b'0', 22),
	(107, 6, 33, 2000.000, '0.00', '2014-11-11 19:51:48', 0, '0000-00-00 00:00:00', 0, b'0', 23),
	(106, 5, 33, 2000.000, '0.00', '2014-11-11 19:51:48', 0, '0000-00-00 00:00:00', 0, b'0', 23),
	(105, 4, 33, 2000.000, '0.00', '2014-11-11 19:51:48', 0, '0000-00-00 00:00:00', 0, b'0', 23),
	(104, 3, 33, 2000.000, '0.00', '2014-11-11 19:51:48', 0, '0000-00-00 00:00:00', 0, b'0', 23),
	(78, 1, 40, 12.000, 'null', '2014-11-07 19:05:34', 0, '0000-00-00 00:00:00', 0, b'0', 23),
	(110, 3, 3, 121.000, '0.00', '2014-11-14 11:20:30', 0, '0000-00-00 00:00:00', 0, b'0', 1),
	(108, 1, 3, 121.000, '0.00', '2014-11-14 11:20:30', 0, '0000-00-00 00:00:00', 0, b'0', 1),
	(109, 2, 3, 121.000, '0.00', '2014-11-14 11:20:30', 0, '0000-00-00 00:00:00', 0, b'0', 1),
	(114, 7, 3, 121.000, '0.00', '2014-11-14 11:20:30', 0, '0000-00-00 00:00:00', 0, b'0', 1),
	(113, 6, 3, 121.000, '0.00', '2014-11-14 11:20:30', 0, '0000-00-00 00:00:00', 0, b'0', 1),
	(103, 2, 33, 2000.000, '0.00', '2014-11-11 19:51:48', 0, '0000-00-00 00:00:00', 0, b'0', 23),
	(102, 1, 33, 2000.000, '0.00', '2014-11-11 19:51:48', 0, '0000-00-00 00:00:00', 0, b'0', 23),
	(115, 1, NULL, 1000.000, '0.00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, b'0', 15),
	(116, 2, NULL, 1000.000, '0.00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, b'0', 13),
	(117, 3, NULL, 1000.000, '0.00', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, b'0', 15),
	(118, 4, NULL, 1000.000, '0', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, b'0', 15),
	(119, 5, NULL, 1000.000, NULL, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, b'0', 15),
	(120, 6, NULL, 1000.000, NULL, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, b'0', 15),
	(121, 7, NULL, 1000.000, NULL, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, b'0', 15),
	(122, 8, NULL, 1000.000, NULL, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, b'0', 15),
	(164, NULL, 8, 100.000, NULL, '0000-00-00 00:00:00', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(163, NULL, 7, 100.000, NULL, '0000-00-00 00:00:00', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(162, NULL, 6, 100.000, NULL, '0000-00-00 00:00:00', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(135, 5, 14, 1000.000, '0.00', '2014-11-19 19:37:29', 0, '0000-00-00 00:00:00', 0, b'0', 23),
	(161, NULL, 5, 100.000, NULL, '0000-00-00 00:00:00', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(160, NULL, 4, 100.000, NULL, '0000-00-00 00:00:00', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(159, NULL, 2, 100.000, NULL, '0000-00-00 00:00:00', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(158, 1, 15, 100.000, NULL, '0000-00-00 00:00:00', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(149, 5, 24, 200.000, '0.00', '2014-11-20 17:48:14', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(148, 3, 24, 200.000, '0.00', '2014-11-20 17:48:14', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(147, 1, 24, 200.000, '0.00', '2014-11-20 17:48:14', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(150, 7, 24, 200.000, '0.00', '2014-11-20 17:48:14', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(179, 1, 27, 220.000, '0.00', '2014-11-21 02:54:08', 26, '0000-00-00 00:00:00', 0, b'0', 23),
	(169, 7, 15, 100.000, NULL, '0000-00-00 00:00:00', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(170, 8, 15, 100.000, NULL, '0000-00-00 00:00:00', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(171, 1, 25, 200.000, '0.00', '2014-11-21 01:38:59', 23, '0000-00-00 00:00:00', 0, b'0', 22),
	(172, 2, 25, 200.000, '0.00', '2014-11-21 01:38:59', 23, '0000-00-00 00:00:00', 0, b'0', 22),
	(173, 3, 25, 200.000, '0.00', '2014-11-21 01:38:59', 23, '0000-00-00 00:00:00', 0, b'0', 22),
	(174, 4, 25, 200.000, '0.00', '2014-11-21 01:38:59', 23, '0000-00-00 00:00:00', 0, b'0', 22),
	(175, 5, 25, 200.000, '0.00', '2014-11-21 01:38:59', 23, '0000-00-00 00:00:00', 0, b'0', 22),
	(176, 6, 25, 200.000, '0.00', '2014-11-21 01:38:59', 23, '0000-00-00 00:00:00', 0, b'0', 22),
	(177, 7, 25, 200.000, '0.00', '2014-11-21 01:38:59', 23, '0000-00-00 00:00:00', 0, b'0', 22),
	(178, 8, 25, 200.000, '0.00', '2014-11-21 01:38:59', 23, '0000-00-00 00:00:00', 0, b'0', 22),
	(180, 2, 27, 220.000, '0.00', '2014-11-21 02:54:08', 26, '0000-00-00 00:00:00', 0, b'0', 23),
	(181, 3, 27, 220.000, '0.00', '2014-11-21 02:54:08', 26, '0000-00-00 00:00:00', 0, b'0', 23),
	(182, 4, 27, 220.000, '0.00', '2014-11-21 02:54:08', 26, '0000-00-00 00:00:00', 0, b'0', 23),
	(183, 5, 27, 220.000, '0.00', '2014-11-21 02:54:08', 26, '0000-00-00 00:00:00', 0, b'0', 23),
	(184, 6, 27, 220.000, '0.00', '2014-11-21 02:54:08', 26, '0000-00-00 00:00:00', 0, b'0', 23),
	(185, 7, 27, 220.000, '0.00', '2014-11-21 02:54:08', 26, '0000-00-00 00:00:00', 0, b'0', 23),
	(186, 8, 27, 220.000, '0.00', '2014-11-21 02:54:08', 26, '0000-00-00 00:00:00', 0, b'0', 23),
	(187, 1, 28, 1000.000, '0.00', '2014-11-21 03:42:10', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(188, 2, 28, 1000.000, '0.00', '2014-11-21 03:42:10', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(189, 3, 28, 1000.000, '0.00', '2014-11-21 03:42:10', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(223, 8, 30, 100.000, '0.00', '2014-11-21 07:32:15', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(222, 6, 30, 100.000, '0.00', '2014-11-21 07:32:15', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(221, 4, 30, 100.000, '0.00', '2014-11-21 07:32:15', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(220, 3, 30, 100.000, '0.00', '2014-11-21 07:32:15', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(219, 2, 30, 100.000, '0.00', '2014-11-21 07:32:15', 15, '0000-00-00 00:00:00', 0, b'0', 1),
	(218, 1, 30, 100.000, '0.00', '2014-11-21 07:32:15', 15, '0000-00-00 00:00:00', 0, b'0', 1);
/*!40000 ALTER TABLE `tblempaccessmap` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblempexprpt
CREATE TABLE IF NOT EXISTS `tblempexprpt` (
  `a_ReportId` bigint(20) NOT NULL AUTO_INCREMENT,
  `t_ReportName` varchar(250) NOT NULL,
  `n_ReportTypeId` smallint(6) NOT NULL,
  `d_ClaimFrom` datetime NOT NULL,
  `d_ClaimTo` datetime NOT NULL,
  `n_CashAdvance` decimal(10,2) DEFAULT NULL,
  `n_PreExpAmt` decimal(10,2) DEFAULT NULL,
  `b_Active` bit(1) NOT NULL,
  `b_Deleted` bit(1) NOT NULL,
  `n_CreatedBy` int(11) DEFAULT NULL,
  `d_CreatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `n_ModifiedBy` bigint(20) DEFAULT NULL,
  `n_ModifiedOn` datetime NOT NULL,
  `n_BusinessId` int(11) DEFAULT NULL,
  `n_status` enum('save','submit','Delete','Reject') DEFAULT NULL,
  `n_ApprovedBy` int(11) NOT NULL,
  `d_ApprovedOn` datetime NOT NULL,
  `b_Approved` bit(1) DEFAULT NULL,
  `n_DeptId` int(11) NOT NULL,
  `n_AmountReq` decimal(12,5) DEFAULT NULL,
  `b_IsVoilated` bit(1) DEFAULT b'0',
  `t_ReportDesc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`a_ReportId`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblempexprpt: ~149 rows (approximately)
/*!40000 ALTER TABLE `tblempexprpt` DISABLE KEYS */;
INSERT INTO `tblempexprpt` (`a_ReportId`, `t_ReportName`, `n_ReportTypeId`, `d_ClaimFrom`, `d_ClaimTo`, `n_CashAdvance`, `n_PreExpAmt`, `b_Active`, `b_Deleted`, `n_CreatedBy`, `d_CreatedOn`, `n_ModifiedBy`, `n_ModifiedOn`, `n_BusinessId`, `n_status`, `n_ApprovedBy`, `d_ApprovedOn`, `b_Approved`, `n_DeptId`, `n_AmountReq`, `b_IsVoilated`, `t_ReportDesc`) VALUES
	(1, 'Report Name 2', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', 1, '2014-11-13 18:04:30', 0, '0000-00-00 00:00:00', 1, 'submit', 1, '2014-11-20 16:02:10', b'1', 1, 1000.00000, b'0', 'kjndvhsdbjvsdf'),
	(2, 'Report Name1 ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', 1, '2014-11-13 18:04:35', NULL, '0000-00-00 00:00:00', 1, 'submit', 0, '0000-00-00 00:00:00', b'0', 1, 2000.00000, b'0', 'kjndvhsdbjvsdf'),
	(3, 'Report Name3 ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', 3, '2014-11-13 18:04:37', NULL, '0000-00-00 00:00:00', 1, 'submit', 0, '0000-00-00 00:00:00', b'0', 1, 2000.00000, b'0', 'kjndvhsdbjvsdf'),
	(4, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', 3, '2014-11-13 18:05:08', NULL, '0000-00-00 00:00:00', 1, 'save', 0, '0000-00-00 00:00:00', NULL, 1, 3000.00000, b'0', 'kjndvhsdbjvsdf'),
	(5, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', 3, '2014-11-13 18:11:04', NULL, '0000-00-00 00:00:00', 1, 'submit', 0, '0000-00-00 00:00:00', NULL, 1, 1200.00000, b'0', 'kjndvhsdbjvsdf'),
	(6, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:11:24', NULL, '0000-00-00 00:00:00', NULL, 'submit', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', ''),
	(7, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:12:01', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(8, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:12:16', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(9, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:12:16', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(10, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:13:03', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(11, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:13:32', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(12, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:13:57', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(13, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:14:31', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(14, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:14:31', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(15, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:14:53', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(16, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:14:58', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(17, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:16:27', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(18, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:16:27', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(19, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:16:45', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(20, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:16:45', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(21, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:17:18', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(22, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:17:18', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(23, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:17:44', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(24, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:17:44', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(25, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:17:57', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(26, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:17:57', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(27, 'Report Name ', 0, '2014-11-13 00:00:00', '2014-11-27 00:00:00', 2112.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:18:51', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(28, 'dsds', 0, '2014-11-13 00:00:00', '0000-00-00 00:00:00', 4343.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:26:55', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(29, '4343', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:28:34', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(30, 'fdf', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 343.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:29:54', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(31, 'fdf', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 343.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:29:59', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(32, 'fdf', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 343.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:30:41', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(33, 'kjl,', 0, '2014-11-13 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:34:07', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(34, 'SDSD', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:44:16', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(35, 'SDSD', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:44:18', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(36, 'dffd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:45:10', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(37, 'dffd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:45:42', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(38, 'dffd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:45:43', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(39, 'dffd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:45:46', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(40, 'dffd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:46:05', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(41, 'dffd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:46:07', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(42, 'fhfghf', 0, '2014-11-06 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:53:13', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(43, 'fhfghf', 0, '2014-11-06 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:53:14', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(44, 'fhfghf', 0, '2014-11-06 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:55:22', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(45, 'fhfghf', 0, '2014-11-06 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:55:55', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(46, 'fhfghf', 0, '2014-11-06 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:55:59', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(47, 'fhfghf', 0, '2014-11-06 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 18:59:09', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(48, 'fhfghf', 0, '2014-11-06 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 19:00:33', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(49, 'fhfghf', 0, '2014-11-06 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 19:00:59', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(50, 'fhfghf', 0, '2014-11-06 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 19:01:32', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(51, 'fhfghf', 0, '2014-11-06 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 19:02:16', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(52, 'fhfghf', 0, '2014-11-06 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 19:02:38', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(53, 'fhfghf', 0, '2014-11-06 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-13 19:04:11', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(54, 'gfgf', 0, '2014-11-13 00:00:00', '2014-11-14 00:00:00', 434.00, 0.00, b'0', b'0', NULL, '2014-11-13 19:51:17', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(55, 'gfgf', 0, '2014-11-13 00:00:00', '2014-11-14 00:00:00', 434.00, 0.00, b'0', b'0', NULL, '2014-11-13 19:53:34', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(56, 'gfgf', 0, '2014-11-13 00:00:00', '2014-11-14 00:00:00', 434.00, 0.00, b'0', b'0', NULL, '2014-11-13 19:54:01', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(57, 'gfgf', 0, '2014-11-13 00:00:00', '2014-11-14 00:00:00', 434.00, 0.00, b'0', b'0', NULL, '2014-11-13 19:54:53', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(58, 'gfgf', 0, '2014-11-13 00:00:00', '2014-11-14 00:00:00', 434.00, 0.00, b'0', b'0', NULL, '2014-11-13 19:55:27', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(59, 'gfgf', 0, '2014-11-13 00:00:00', '2014-11-14 00:00:00', 434.00, 0.00, b'0', b'0', NULL, '2014-11-13 19:55:28', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(60, 'bks', 0, '2014-11-14 00:00:00', '2014-11-16 00:00:00', 343.00, 343.00, b'0', b'0', NULL, '2014-11-14 11:14:24', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(61, 'sdfsdf', 0, '2014-11-14 00:00:00', '2014-11-23 00:00:00', 3434.00, 3434.00, b'0', b'0', NULL, '2014-11-14 20:23:32', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(62, 'sdfsdf', 0, '2014-11-14 00:00:00', '2014-11-23 00:00:00', 3434.00, 3434.00, b'0', b'0', NULL, '2014-11-14 20:23:32', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(63, 'sdfsdf', 0, '2014-11-14 00:00:00', '2014-11-23 00:00:00', 3434.00, 3434.00, b'0', b'0', NULL, '2014-11-14 20:23:37', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(64, 'sdfsdf', 0, '2014-11-14 00:00:00', '2014-11-23 00:00:00', 3434.00, 3434.00, b'0', b'0', NULL, '2014-11-14 20:23:37', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(65, 'sdfsdf', 0, '2014-11-14 00:00:00', '2014-11-27 00:00:00', 3232.00, 2323.00, b'0', b'0', NULL, '2014-11-14 20:26:13', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(66, 'sdfsdf', 0, '2014-11-14 00:00:00', '2014-11-27 00:00:00', 3232.00, 2323.00, b'0', b'0', NULL, '2014-11-14 20:26:13', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(67, 'sdfsdf', 0, '2014-11-14 00:00:00', '2014-11-27 00:00:00', 3232.00, 2323.00, b'0', b'0', NULL, '2014-11-14 20:26:14', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(68, 'sdfsdf', 0, '2014-11-14 00:00:00', '2014-11-27 00:00:00', 3232.00, 2323.00, b'0', b'0', NULL, '2014-11-14 20:26:14', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(69, 'sdf', 0, '2014-11-14 00:00:00', '2014-11-28 00:00:00', 423423.00, 324234.00, b'0', b'0', NULL, '2014-11-14 20:28:17', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(70, 'sdf', 0, '2014-11-14 00:00:00', '2014-11-28 00:00:00', 423423.00, 324234.00, b'0', b'0', NULL, '2014-11-14 20:28:17', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(71, 'sdsdf', 0, '2014-11-14 00:00:00', '2014-11-26 00:00:00', 3232.00, 2323.00, b'0', b'0', NULL, '2014-11-14 20:36:43', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(72, 'sdsdf', 0, '2014-11-14 00:00:00', '2014-11-26 00:00:00', 3232.00, 2323.00, b'0', b'0', NULL, '2014-11-14 20:36:50', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(73, 'sdsdf', 0, '2014-11-14 00:00:00', '2014-11-26 00:00:00', 3232.00, 2323.00, b'0', b'0', NULL, '2014-11-14 20:36:55', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(74, 'sdsdf', 0, '2014-11-14 00:00:00', '2014-11-26 00:00:00', 3232.00, 2323.00, b'0', b'0', NULL, '2014-11-14 20:37:12', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(75, 'sdsdf', 0, '2014-11-14 00:00:00', '2014-11-26 00:00:00', 3232.00, 2323.00, b'0', b'0', NULL, '2014-11-14 20:37:13', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(76, 'sdsdf', 0, '2014-11-14 00:00:00', '2014-11-26 00:00:00', 3232.00, 2323.00, b'0', b'0', NULL, '2014-11-14 20:37:13', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(77, 'qewew', 0, '2014-11-14 00:00:00', '2014-11-27 00:00:00', 132.00, 3232.00, b'0', b'0', NULL, '2014-11-14 20:37:34', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(78, 'qewew', 0, '2014-11-14 00:00:00', '2014-11-27 00:00:00', 132.00, 3232.00, b'0', b'0', NULL, '2014-11-14 20:37:35', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(79, 'qewew', 0, '2014-11-14 00:00:00', '2014-11-27 00:00:00', 132.00, 3232.00, b'0', b'0', NULL, '2014-11-14 20:38:14', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(80, '232', 0, '2014-11-20 00:00:00', '2014-11-19 00:00:00', 3232.00, 232.00, b'0', b'0', NULL, '2014-11-14 20:39:16', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(81, '232', 0, '2014-11-20 00:00:00', '2014-11-19 00:00:00', 3232.00, 232.00, b'0', b'0', NULL, '2014-11-14 20:39:16', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(82, 'fsdfsdf', 0, '2014-11-15 00:00:00', '2014-11-22 00:00:00', 0.00, 343.00, b'0', b'0', NULL, '2014-11-15 09:51:09', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(83, 'fsdfsdf', 0, '2014-11-15 00:00:00', '2014-11-22 00:00:00', 0.00, 343.00, b'0', b'0', NULL, '2014-11-15 09:51:09', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(84, 'Report Name', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 200.00, 0.00, b'0', b'0', NULL, '2014-11-18 18:58:33', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(85, 'Report Name', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 200.00, 0.00, b'0', b'0', NULL, '2014-11-18 18:58:33', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(86, 'sdf', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 234.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:26:02', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(87, 'sdf', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 234.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:26:02', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(88, 'sdfgd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:53:05', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(89, 'sdfgd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:53:05', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(90, 'sdfgd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:53:35', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(91, 'sdfgd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:53:36', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(92, 'sdfgd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:53:36', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(93, 'sdfgd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:53:36', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(94, 'sdfgd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:53:38', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(95, 'sdfgd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:53:38', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(96, 'sdfgd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:53:39', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(97, 'sdfgd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:53:39', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(98, 'sdfgd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:53:40', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(99, 'sdfgd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:53:40', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(100, 'sdfgd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:53:40', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(101, 'sdfgd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:53:40', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(102, 'dfgdfg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:58:07', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(103, 'dfgdfg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:58:07', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(104, 'dfgdfg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:58:12', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(105, 'dfgdfg', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-18 19:58:12', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(106, 'yhhdfh', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 45345.00, 345345.00, b'0', b'0', NULL, '2014-11-19 20:18:30', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(107, 'yhhdfh', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 45345.00, 345345.00, b'0', b'0', NULL, '2014-11-19 20:18:30', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(108, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:16:31', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(109, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:16:31', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(110, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:17:39', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(111, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:17:39', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(112, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:18:42', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(113, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:18:42', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(114, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:18:46', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(115, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:18:46', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(116, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:18:47', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(117, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:18:47', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(118, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:18:48', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(119, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:18:48', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(120, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:18:50', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(121, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:18:50', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(122, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:18:50', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(123, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:18:51', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(124, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:18:51', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(125, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:18:51', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(126, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:19:36', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(127, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:19:36', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(128, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:19:38', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(129, 'asdasd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:19:38', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(130, 'Report Name', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 123.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:19:59', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(131, 'Report Name', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 123.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:19:59', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(132, 'Report Named', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 123.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:20:08', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(133, 'Report Named', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 123.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:20:08', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(134, 'Report Named', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 123.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:20:53', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(135, 'Report Named', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 123.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:20:53', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(136, 'asdfas', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 23432.00, 2.00, b'0', b'0', NULL, '2014-11-20 11:21:55', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(137, 'asdfas', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 23432.00, 2.00, b'0', b'0', NULL, '2014-11-20 11:21:55', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(138, 'sdfsd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 24234.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:24:33', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(139, 'sdfsd', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 24234.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:24:33', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(140, 'Report Name', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 36456.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:30:59', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(141, 'Report Name', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 36456.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:30:59', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(142, 'Report Name', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:32:22', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(143, 'Report Name', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:32:22', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(144, 'Report Name', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:34:13', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(145, 'Report Name', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:34:13', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(146, 'Report Name', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 234.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:37:19', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(147, 'Report Name', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 234.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:37:19', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(148, 'Report Name', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 234.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:42:28', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL),
	(149, 'Report Name', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 234.00, 0.00, b'0', b'0', NULL, '2014-11-20 11:42:28', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0000-00-00 00:00:00', NULL, 0, NULL, b'0', NULL);
/*!40000 ALTER TABLE `tblempexprpt` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblemployeemaster
CREATE TABLE IF NOT EXISTS `tblemployeemaster` (
  `a_EmpId` int(254) NOT NULL AUTO_INCREMENT,
  `is_Admin` bit(1) NOT NULL DEFAULT b'0',
  `t_EmpCode` varchar(50) NOT NULL,
  `t_EmpFirstName` varchar(100) NOT NULL,
  `t_EmpMidName` varchar(50) DEFAULT NULL,
  `t_EmpLastName` varchar(50) DEFAULT NULL,
  `n_Designation` int(100) DEFAULT NULL,
  `n_DeptId` int(100) DEFAULT NULL,
  `n_PolicyId` int(100) DEFAULT NULL,
  `t_EmaiId` varchar(100) DEFAULT NULL,
  `t_Password` varchar(100) DEFAULT NULL,
  `t_OfficePhone` varchar(20) DEFAULT NULL,
  `t_MobilePhone` varchar(20) DEFAULT NULL,
  `d_EmpDOB` varchar(255) DEFAULT NULL,
  `d_EmpDOJ` datetime DEFAULT NULL,
  `d_CreatedOn` bigint(254) NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  `b_Deleted` bit(2) DEFAULT NULL,
  `n_BusinessId` int(11) DEFAULT NULL,
  `n_AdminType` int(11) DEFAULT NULL,
  `b_IsSuperAdmin` bit(11) DEFAULT NULL,
  `t_AddfLine` varchar(150) DEFAULT NULL,
  `t_AddSecLine` varchar(150) DEFAULT NULL,
  `t_AddThirdLine` varchar(150) DEFAULT NULL,
  `n_CountryId` int(11) DEFAULT NULL,
  `n_StateId` int(11) DEFAULT NULL,
  `n_CityId` int(11) DEFAULT NULL,
  `n_PinCode` int(11) DEFAULT NULL,
  `n_seqAns` varchar(255) NOT NULL,
  `n_Status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`a_EmpId`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblemployeemaster: 33 rows
/*!40000 ALTER TABLE `tblemployeemaster` DISABLE KEYS */;
INSERT INTO `tblemployeemaster` (`a_EmpId`, `is_Admin`, `t_EmpCode`, `t_EmpFirstName`, `t_EmpMidName`, `t_EmpLastName`, `n_Designation`, `n_DeptId`, `n_PolicyId`, `t_EmaiId`, `t_Password`, `t_OfficePhone`, `t_MobilePhone`, `d_EmpDOB`, `d_EmpDOJ`, `d_CreatedOn`, `n_CreatedBy`, `d_ModifiedOn`, `n_ModifiedBy`, `b_Deleted`, `n_BusinessId`, `n_AdminType`, `b_IsSuperAdmin`, `t_AddfLine`, `t_AddSecLine`, `t_AddThirdLine`, `n_CountryId`, `n_StateId`, `n_CityId`, `n_PinCode`, `n_seqAns`, `n_Status`) VALUES
	(1, b'0', 'mind00_3', 'vyom', NULL, 'man', NULL, 1, 4, NULL, NULL, '15616316', '124984651', '2014-11-08 00:00:00', NULL, 2014, 0, '2014-11-13 18:54:21', 0, b'01', 1, NULL, NULL, 'sfs', 'safcvv', 'sfvsdv', 1, 1, 1, 236461, '', b'1'),
	(2, b'0', '121', 'sdv', NULL, 'gfhfg', NULL, 1, 5, NULL, 'd41d8cd98f00b204e9800998ecf8427e', 'ssefv', 'f sdfs', '2014-11-09 00:00:00', NULL, 2014, 0, '2014-11-08 10:06:03', 0, b'00', 1, NULL, NULL, 'p_AddFLine', 'p_AddSecLine', 'p_AddThrdLine', 1, 1, 1, 123, '', b'0'),
	(61, b'0', 'z12', 'Computer', NULL, 'man', NULL, 13, 2, 'xyz1@gmail.com', 'e48f4f260fb9b7a6876e7153d53298f1', '15616316', '546456', '2014-11-20 00:00:00', NULL, 2014, 15, '2014-11-21 07:34:32', 15, b'00', 1, 33, NULL, 'hsdcdsc', 'safcvv', 'sdkvbdsjbvd', 1, 1, 1, 236461, '', b'1'),
	(16, b'0', 'cvsc', 'avshc', NULL, 'vabs', NULL, 1, 0, NULL, NULL, '1', '2014-01-02', '0000-00-00 00:00:00', NULL, 2014, -1, '0000-00-00 00:00:00', 0, b'00', 22, NULL, NULL, 'fgf', 'vcgfdt', 'zsdaer', 1, 1, 1, 0, '', b'1'),
	(60, b'0', '23', 'sdv', NULL, 'dvsdvsd', NULL, 4, 4, 'gsf@gmail.com', 'e30237d8d85425505b870c1b197ff99d', '34646', '1234567890', '2014-11-20 00:00:00', NULL, 2014, 15, '0000-00-00 00:00:00', 0, b'01', 1, 33, NULL, 'hsdcdsc', 'sbfjsdbf', 'sdkvbdsjbvd', 1, 1, 1, 236461, '', b'1'),
	(59, b'0', 'mindz_03', 'Mindz', NULL, 'Elite', NULL, 2, 2, 'mindz@gmail.com', 'a30b36cd9c2e0343ae527b263a7b0abb', '45435', '546456', '2014-11-21 00:00:00', NULL, 2014, 15, '2014-11-21 01:51:56', 15, b'00', 1, 33, NULL, 'ax', 'sbfjsdbf', 'sdkvbdsjbvd', 2, 2, 2, 4565465, '', b'1'),
	(58, b'0', 'jshd', 'dfgbdfb', NULL, 'Ahmad', NULL, 3, 2, 'fdg@gmail.com', '694eabca410cc15c81fab9dc514a629e', '45435', '55555', '2014-11-19 00:00:00', NULL, 2014, 15, '0000-00-00 00:00:00', 0, b'00', 1, 33, NULL, 'hsdcdsc', 'safcvv', 'sfvsdv', 2, 2, 2, 166556, '', b'1'),
	(57, b'0', 'sdfsd', 'vyom', NULL, 'dbhfb', NULL, 5, 3, 'fgh@gmail.com', 'f4db8537e9d75da46c4efc36a2d70956', '34646', '546456', '2014-11-20 00:00:00', NULL, 2014, 15, '0000-00-00 00:00:00', 0, b'01', 1, 33, NULL, 'dgdsgdg', 'sbfjsdbf', 'sdkvbdsjbvd', 2, 2, 2, 236461, '', b'1'),
	(56, b'0', 'mind00_3', 'Azhar', NULL, 'dbhfb', NULL, 2, 1, 'xyz@gmail.com', 'ebd9cbfb90ae6a1daeefe91a4cfaa518', '15616316', '546456', '2014-11-12 00:00:00', NULL, 2014, 15, '0000-00-00 00:00:00', 0, b'00', 1, 1, NULL, 'sfs', 'sef', 'sdkvbdsjbvd', 2, 2, 2, 236461, '', b'1'),
	(55, b'0', '112', 'sdfasdf', NULL, 'asdfsa', NULL, 1, 1, 'alsdfk@gmail.com', '96e79218965eb72c92a549dd5a330112', '9990617303', '9990617303', '0000-00-00 00:00:00', NULL, 2014, 0, '2014-11-20 17:10:40', 0, b'00', 22, NULL, NULL, 'fasdfa', 'asdfasdfa', 'sdfasdfasd', 1, 1, 1, 12342131, 'hello', b'1'),
	(54, b'1', 'BUSEMP123', 'SHEETESH', NULL, 'GAUTAM', NULL, 5, 5, 'rahul@mindztdddechnology.com', 'dg1OItiC', '011454578', '12121212121212', '0000-00-00 00:00:00', NULL, 2014, 0, '0000-00-00 00:00:00', 0, b'00', 16, NULL, NULL, 'SAGARPUR', 'MOHAN nAGAR', 'D-BLOCK', 1, 1, 1, 2147483647, '', b'1'),
	(31, b'0', 'e54', 'fgvsdgrh', NULL, 'rdhrfb', NULL, 3, 4646, NULL, NULL, '2', 'rhrh', '0000-00-00 00:00:00', NULL, 2014, 0, '0000-00-00 00:00:00', 0, b'01', 22, NULL, NULL, '0', 'hrdghdr', 'hrthr', 2, 2, 2, 54654, '', b'1'),
	(32, b'0', '2315', 'Ajkfd', NULL, 'afsfsf', NULL, 5, 34646, NULL, NULL, '2', 'grdgrg', '0000-00-00 00:00:00', NULL, 2014, 0, '0000-00-00 00:00:00', 0, b'00', 22, NULL, NULL, '0', 'yjyt', 'nftghngtfhtfrhjn', 1, 1, 3, 4354, '', b'1'),
	(33, b'0', '354', 'etv', NULL, 'zee', NULL, 4, 2, NULL, NULL, '4345654', '456565', '2014-11-13 00:00:00', NULL, 2014, 0, '0000-00-00 00:00:00', 0, b'00', 22, NULL, NULL, 'sdgvbdfbf', 'bdfbfb', 'fdbdfbf', 1, 1, 3, 465465, '', b'1'),
	(34, b'1', '54t', 'azhar', NULL, 'ahmad', NULL, 3, NULL, NULL, NULL, '4546', '5645654', '2014-11-06 00:00:00', NULL, 2014, 0, '0000-00-00 00:00:00', 0, b'00', 22, NULL, NULL, 'dfxgbdfgb', 'fdgbzfb', 'fbdfbfbdb', 1, 1, 1, 645645, '', b'1'),
	(35, b'1', '35435', 'djvdbvdbv', NULL, 'sdvsdvsd', NULL, 4, NULL, NULL, NULL, '465465', '546546', '2014-11-12 00:00:00', NULL, 2014, 0, '0000-00-00 00:00:00', 0, b'00', 22, NULL, NULL, 'dfgddfg', 'grdgrdgr', 'drgdrgdg', 1, 1, 1, 346546, '', b'1'),
	(36, b'1', '54354', 'sdfvdsvdfbvdfbfbfdbfdb', NULL, 'fdbdfbdfbdfbdfbdfbdfbdf', NULL, 3, NULL, NULL, NULL, '46546546', '5654654', '2014-11-06 00:00:00', NULL, 2014, 0, '0000-00-00 00:00:00', 0, b'01', 22, NULL, NULL, 'rhdfgbdfb', 'dfbdfbd', 'dfbdfbdfrb', 1, 1, 3, 5645465, '', b'1'),
	(37, b'1', '54354', 'sdfvdsvdfbvdfbfbfdbfdb', NULL, 'fdbdfbdfbdfbdfbdfbdfbdf', NULL, 3, NULL, NULL, NULL, '46546546', '5654654', '2014-11-06 00:00:00', NULL, 2014, 0, '0000-00-00 00:00:00', 0, b'00', 22, NULL, NULL, 'rhdfgbdfb', 'dfbdfbd', 'dfbdfbdfrb', 1, 1, 3, 5645465, '', b'1'),
	(38, b'1', '34', 'a', NULL, 'a', NULL, 1, 1, NULL, NULL, '2', '2', '2014-11-05 00:00:00', NULL, 2014, 0, '0000-00-00 00:00:00', 0, b'00', 22, NULL, NULL, 'fvf', 'fvs', 'svrf', 1, 1, 1, 35, '', b'0'),
	(39, b'0', '4', 'b', NULL, 'b', NULL, 4, 3, NULL, NULL, '5', '5', '2014-11-12 00:00:00', NULL, 2014, 0, '0000-00-00 00:00:00', 0, b'01', 22, NULL, NULL, 'df', 'dfg', 'fzdfg', 2, 2, 2, 5, '', b'1'),
	(40, b'1', '4', 'f', NULL, 'f', NULL, 1, 0, NULL, NULL, '4', '6', '2014-11-05 00:00:00', NULL, 2014, 0, '0000-00-00 00:00:00', 0, b'00', 22, NULL, NULL, 'g', 'g', 'g', 1, 1, 1, 5, '', b'1'),
	(41, b'0', '12', 'xyz', NULL, 'abc', NULL, 3, 1, NULL, NULL, '15616316', '546456', '2014-11-11 00:00:00', NULL, 2014, 0, '0000-00-00 00:00:00', 0, b'00', 22, NULL, NULL, 'hsdcdsc', 'sbfjsdbf', 'dsgg', 1, 1, 1, 236461, '', b'1'),
	(42, b'0', '12', 'xyz', NULL, '124ghg', NULL, 3, 5, NULL, NULL, '15616316', '546456', '2014-11-11 00:00:00', NULL, 2014, 0, '2014-11-12 17:07:44', 0, b'01', 2, NULL, NULL, 'hsdcdsc', 'sbfjsdbf', 'sdkvbdsjbvd', 1, 1, 1, 236461, '', b'1'),
	(43, b'0', '35', 'sfds', NULL, 'fghnf', NULL, 1, 1, NULL, NULL, '4565', '456456', '2014-11-11 00:00:00', NULL, 2014, 0, '0000-00-00 00:00:00', 0, b'01', 2, NULL, NULL, 'fgff', 'bfbfb', 'fdbfbf', 1, 1, 1, 5656, '', b'0'),
	(44, b'0', '4e54', 'Azhar', NULL, 'xyz', NULL, 3, 2, NULL, NULL, '34646', '546456', '2014-11-11 00:00:00', NULL, 2014, 0, '0000-00-00 00:00:00', 0, b'01', 1, NULL, NULL, 'sfs', 'sbfjsdbf', 'sfvsdv', 1, 1, 1, 236461, '', b'1'),
	(46, b'0', 'TRU121', 'SHEETESH', NULL, 'DUBEY', NULL, 2, 2, 'sheetesh@mindztechnology.com', 'H63TZlMv', '0114545781', '9715754875', '2014-11-13 00:00:00', NULL, 2014, 0, '2014-11-20 12:13:21', 0, b'00', 2, NULL, NULL, 'SAGARPUR', 'MOHAN NAGAR', 'D-BLOCK1', 0, 1, 1, 110049, 'sheetesh1', b'1'),
	(47, b'0', 'TRU121', 'SHEETESH', NULL, 'Dubey', NULL, 2, 1, 'sheetesh@gmail.com', 'rpf1I68Q', '011454578', '9715754875', '0000-00-00 00:00:00', NULL, 2014, 0, '0000-00-00 00:00:00', 0, b'00', 2, NULL, NULL, 'SAGARPUR', 'MOHAN nAGAR', 'D-BLOCK', 0, 1, 1, 110046, '', b'1'),
	(48, b'0', 'BUSEMP121', 'KARUNA', NULL, 'GAUTAM', NULL, 1, 1, 'karuna92@gmail.com', '8qlvNDCd', '011454578', '9715754875', '0000-00-00 00:00:00', NULL, 2014, 0, '0000-00-00 00:00:00', 0, b'00', 2, NULL, NULL, 'SAGARPUR', 'MOHAN nAGAR', 'D-BLOCK', 0, 1, 1, 110046, '', b'1'),
	(49, b'0', '', 's', NULL, '', NULL, 0, 0, '', 'pucePlv2', '', '', '0000-00-00 00:00:00', NULL, 2014, 0, '0000-00-00 00:00:00', 0, b'00', 2, NULL, NULL, '', '', '', 0, 0, 0, 0, '', b'0'),
	(50, b'0', '', '', NULL, '', NULL, 0, 0, '', 'DjqkApr5', '', '', '0000-00-00 00:00:00', NULL, 2014, 0, '0000-00-00 00:00:00', 0, b'00', 2, NULL, NULL, '', '', '', 0, 0, 0, 0, '', b'0'),
	(51, b'0', 'BUSEMP121f', 'KARUNAfdsdfv', NULL, 'GAUTAMvfdsvdf', NULL, 3, 3, 'karuna921@gmail.com', 'yg3l0zNZ', '121212212vfd', '12121212121212f', '0000-00-00 00:00:00', NULL, 2014, 0, '2014-11-19 15:16:54', 0, b'00', 2, NULL, NULL, 'SAGARPURsdfsegef', 'MOHAN NAGARgergergr', 'D-BLOCK', 2, 2, 2, 110046, '', b'1'),
	(52, b'0', 'A101', 'Deepesh', NULL, 'singh', NULL, 1, 1, 'richa@mindztechnology.com', '96e79218965eb72c92a549dd5a330112', '987654321', '123654789', '0000-00-00 00:00:00', NULL, 2014, 0, '2014-11-19 14:20:25', 0, b'01', 23, NULL, NULL, 'addr1', 'addr2', 'addr3', 1, 1, 1, 110001, '', b'1'),
	(53, b'0', 'SYS EMP1', 'EK NYA EMP', NULL, 'BY SYS ADMINS', NULL, 3, 3, 'deep@gmail.com', '96e79218965eb72c92a549dd5a330112', '011454578', '9715754875111', '0000-00-00 00:00:00', NULL, 2014, 0, '2014-11-21 19:22:53', 0, b'00', 23, NULL, NULL, 'ASALAT PUR', 'C1', 'LAL SAI MADIR', 2, 2, 2, 110058222, 'www', b'1');
/*!40000 ALTER TABLE `tblemployeemaster` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblemppolicyclaim
CREATE TABLE IF NOT EXISTS `tblemppolicyclaim` (
  `a_PolicyClaimId` int(254) NOT NULL AUTO_INCREMENT,
  `t_RptName` varchar(50) NOT NULL,
  `n_Status` int(11) NOT NULL,
  `n_RptType` int(11) NOT NULL,
  `d_ClaimPrdFrm` datetime NOT NULL,
  `d_ClaimPrdTo` datetime NOT NULL,
  `n_CashAdv` decimal(15,2) NOT NULL,
  `n_PreExpAmt` decimal(15,2) NOT NULL,
  `n_AmtRpted` decimal(15,2) NOT NULL,
  `n_AmtReqted` decimal(15,2) NOT NULL,
  `n_EmpId` bigint(254) NOT NULL,
  `n_AppvAmt` decimal(15,2) NOT NULL,
  `t_Desp` varchar(300) NOT NULL,
  `d_CreatedOn` bigint(254) NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  `b_Deleted` bit(1) NOT NULL,
  `n_BusinessId` int(254) NOT NULL,
  `n_AdminType` int(254) NOT NULL,
  PRIMARY KEY (`a_PolicyClaimId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblemppolicyclaim: 0 rows
/*!40000 ALTER TABLE `tblemppolicyclaim` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblemppolicyclaim` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblexppolicymap
CREATE TABLE IF NOT EXISTS `tblexppolicymap` (
  `a_ExpPlcyMapId` bigint(20) NOT NULL AUTO_INCREMENT,
  `n_ReportId` bigint(20) NOT NULL,
  `n_ExpType` int(11) NOT NULL,
  `d_Date` date NOT NULL,
  `d_DateFrom` date NOT NULL,
  `d_DateTo` datetime NOT NULL,
  `n_CategoriesID` int(11) NOT NULL,
  `n_Distance` decimal(10,0) DEFAULT NULL,
  `t_Amount` decimal(10,0) unsigned DEFAULT NULL,
  `t_Merchant` varchar(240) DEFAULT NULL,
  `t_Purpose` varchar(500) DEFAULT NULL,
  `t_atthFile` varchar(500) DEFAULT NULL,
  `t_City` varchar(50) DEFAULT NULL,
  `b_IsGpsCalculat` bit(1) NOT NULL,
  `b_IsReimburs` bit(1) DEFAULT NULL,
  `n_GLCodeId` int(11) NOT NULL,
  `n_CustomTag1` int(11) DEFAULT NULL,
  `n_CustomTag2` int(11) DEFAULT NULL,
  `t_BookingConfir` varchar(50) NOT NULL,
  `n_FromSource` int(11) DEFAULT NULL,
  `n_ToDestination` int(11) DEFAULT NULL,
  `d_CreatedOn` datetime NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `b_Deleted` bit(1) NOT NULL,
  `b_IsVoilated` bit(1) DEFAULT NULL,
  PRIMARY KEY (`a_ExpPlcyMapId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblexppolicymap: ~1 rows (approximately)
/*!40000 ALTER TABLE `tblexppolicymap` DISABLE KEYS */;
INSERT INTO `tblexppolicymap` (`a_ExpPlcyMapId`, `n_ReportId`, `n_ExpType`, `d_Date`, `d_DateFrom`, `d_DateTo`, `n_CategoriesID`, `n_Distance`, `t_Amount`, `t_Merchant`, `t_Purpose`, `t_atthFile`, `t_City`, `b_IsGpsCalculat`, `b_IsReimburs`, `n_GLCodeId`, `n_CustomTag1`, `n_CustomTag2`, `t_BookingConfir`, `n_FromSource`, `n_ToDestination`, `d_CreatedOn`, `d_ModifiedOn`, `b_Deleted`, `b_IsVoilated`) VALUES
	(1, 1, 1, '2014-12-14', '2014-12-14', '2014-12-14 00:00:00', 1, NULL, 200, 'safvsdvfsdv', 'dbhjdb', '1', NULL, b'0', b'1', 0, NULL, NULL, '', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00', b'0', b'0');
/*!40000 ALTER TABLE `tblexppolicymap` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblguesthouse
CREATE TABLE IF NOT EXISTS `tblguesthouse` (
  `a_GuestHouseId` bigint(20) NOT NULL AUTO_INCREMENT,
  `t_FName` varchar(100) NOT NULL,
  `t_DisplayName` varchar(100) NOT NULL,
  `t_Address` varchar(100) DEFAULT NULL,
  `t_About` varchar(100) DEFAULT NULL,
  `n_Discount` int(10) DEFAULT NULL,
  `d_CheckInTime` time DEFAULT NULL,
  `d_CheckOutTime` time DEFAULT NULL,
  `n_CityID` int(10) DEFAULT NULL,
  `n_StateID` int(10) DEFAULT NULL,
  `n_CountryId` int(10) DEFAULT NULL,
  `b_Active` bit(1) NOT NULL,
  `b_Deleted` bit(1) NOT NULL,
  `n_CreatedBy` bigint(20) NOT NULL,
  `d_CreatedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(20) DEFAULT NULL,
  `n_ModifiedOn` datetime DEFAULT NULL,
  `status` enum('Active','Inactive','Delete') DEFAULT 'Active',
  PRIMARY KEY (`a_GuestHouseId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblguesthouse: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblguesthouse` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblguesthouse` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblmenu
CREATE TABLE IF NOT EXISTS `tblmenu` (
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblmenu: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblmenu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblmenu` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblpolicycategorymap
CREATE TABLE IF NOT EXISTS `tblpolicycategorymap` (
  `a_PlcyCatMapId` int(254) NOT NULL AUTO_INCREMENT,
  `n_PolicyId` int(254) DEFAULT NULL,
  `n_SpndngCatId` int(254) DEFAULT NULL,
  `n_SingleExpLmt` decimal(15,2) DEFAULT NULL,
  `n_DailyExpLmt` decimal(15,2) DEFAULT NULL,
  `n_MonthlyExpLmt` decimal(15,2) DEFAULT NULL,
  `d_CreatedOn` bigint(254) NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  `b_Deleted` bit(1) DEFAULT NULL,
  `n_BusinessId` int(254) NOT NULL,
  PRIMARY KEY (`a_PlcyCatMapId`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblpolicycategorymap: 6 rows
/*!40000 ALTER TABLE `tblpolicycategorymap` DISABLE KEYS */;
INSERT INTO `tblpolicycategorymap` (`a_PlcyCatMapId`, `n_PolicyId`, `n_SpndngCatId`, `n_SingleExpLmt`, `n_DailyExpLmt`, `n_MonthlyExpLmt`, `d_CreatedOn`, `n_CreatedBy`, `d_ModifiedOn`, `n_ModifiedBy`, `b_Deleted`, `n_BusinessId`) VALUES
	(1, 1, 14, 500.00, 1000.00, 10000.00, 2014, 1, '0000-00-00 00:00:00', 1, b'1', 23),
	(2, 1, 15, 500.00, 1000.00, 10000.00, 2014, 1, '0000-00-00 00:00:00', 1, b'1', 23),
	(3, 1, 16, 500.00, 1000.00, 10000.00, 2014, 1, '0000-00-00 00:00:00', 1, b'1', 23),
	(4, 1, 21, 500.00, 1000.00, 10000.00, 2014, 1, '0000-00-00 00:00:00', 1, b'1', 23),
	(12, 2, 21, 700.00, 1000.00, 12000.00, 2014, 1, '0000-00-00 00:00:00', 1, b'1', 0),
	(11, 2, 20, 1000.00, 3000.00, 15000.00, 2014, 1, '0000-00-00 00:00:00', 1, b'1', 0);
/*!40000 ALTER TABLE `tblpolicycategorymap` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblpolicyclaimcatmap
CREATE TABLE IF NOT EXISTS `tblpolicyclaimcatmap` (
  `a_PlcyCatMapId` int(254) NOT NULL AUTO_INCREMENT,
  `n_PlcyTypeId` int(11) NOT NULL,
  `n_SpnCatId` int(11) NOT NULL,
  `d_Date` datetime DEFAULT NULL,
  `t_Purpose` varchar(300) DEFAULT NULL,
  `b_IsReimbrd` bit(1) DEFAULT NULL,
  `b_CustomTag1` bit(1) DEFAULT NULL,
  `t_CustomTag1Val` varchar(500) DEFAULT NULL,
  `b_CustomTag2` bit(1) DEFAULT NULL,
  `t_CustomTag2Val` varchar(500) DEFAULT NULL,
  `n_City` int(11) DEFAULT NULL,
  `t_Merchant` varchar(100) DEFAULT NULL,
  `t_Carrier` varchar(100) DEFAULT NULL,
  `t_name` varchar(500) DEFAULT NULL,
  `d_StrtDate` datetime DEFAULT NULL,
  `d_ReturnDate` datetime DEFAULT NULL,
  `n_From` int(11) DEFAULT NULL,
  `n_To` int(11) DEFAULT NULL,
  `t_BookingConfrm` varchar(50) DEFAULT NULL,
  `n_distance` decimal(15,2) DEFAULT NULL,
  `b_IsGpsCalc` bit(1) DEFAULT NULL,
  `b_Deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`a_PlcyCatMapId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblpolicyclaimcatmap: 0 rows
/*!40000 ALTER TABLE `tblpolicyclaimcatmap` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpolicyclaimcatmap` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblpolicyclaimnotemap
CREATE TABLE IF NOT EXISTS `tblpolicyclaimnotemap` (
  `a_ClaimNoteMapID` int(11) NOT NULL AUTO_INCREMENT,
  `t_ClaimNote` varchar(300) DEFAULT NULL,
  `n_PolicyClaimId` int(11) NOT NULL,
  `b_Deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`a_ClaimNoteMapID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblpolicyclaimnotemap: 0 rows
/*!40000 ALTER TABLE `tblpolicyclaimnotemap` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpolicyclaimnotemap` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblpolicydocumentmap
CREATE TABLE IF NOT EXISTS `tblpolicydocumentmap` (
  `a_PolicyDocMapId` int(11) NOT NULL AUTO_INCREMENT,
  `n_PolicyClaimId` int(11) NOT NULL,
  `t_DocName` varchar(50) NOT NULL,
  `t_Path` varchar(200) NOT NULL,
  `b_Deleted` bit(1) DEFAULT NULL,
  PRIMARY KEY (`a_PolicyDocMapId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblpolicydocumentmap: 0 rows
/*!40000 ALTER TABLE `tblpolicydocumentmap` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpolicydocumentmap` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblpolicymaster
CREATE TABLE IF NOT EXISTS `tblpolicymaster` (
  `a_PolicyId` int(254) NOT NULL AUTO_INCREMENT,
  `t_PolicyName` varchar(50) NOT NULL,
  `n_MaxRptAmt` decimal(15,2) DEFAULT NULL,
  `d_RptDueDt` varchar(50) DEFAULT NULL,
  `d_RptDueDt1` varchar(50) DEFAULT NULL,
  `n_MaxExpAmt` decimal(15,2) DEFAULT NULL,
  `b_CashAdAllowed` bit(1) DEFAULT NULL,
  `b_RecpReq` bit(1) DEFAULT NULL,
  `n_AboveAmt` decimal(15,2) DEFAULT NULL,
  `n_Days` int(11) DEFAULT NULL,
  `n_MaxRptMilage` decimal(15,2) DEFAULT NULL,
  `n_MilageRate` decimal(15,2) DEFAULT NULL,
  `n_PerMeasuremnt` int(11) DEFAULT NULL,
  `n_MaxExpMil` decimal(15,2) DEFAULT NULL,
  `b_IsGPSReq` bit(1) DEFAULT NULL,
  `n_MonthlyExpLmt` decimal(15,2) DEFAULT NULL,
  `n_DailyExpLmt` decimal(15,2) DEFAULT NULL,
  `d_CreatedOn` bigint(254) DEFAULT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `n_CreatedType` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime DEFAULT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  `b_Deleted` int(5) NOT NULL,
  `n_BusinessId` int(254) NOT NULL,
  `n_AdminType` int(254) NOT NULL,
  `n_ReportDueBy` int(11) DEFAULT NULL,
  `t_flagExpSubmitted` varchar(45) DEFAULT NULL,
  `n_MilRateUnitValue` int(11) DEFAULT NULL,
  `n_RptDueByValue` int(11) DEFAULT NULL,
  `t_ModifiedByType` enum('SYSTEMADMIN','ADMIN') DEFAULT NULL,
  PRIMARY KEY (`a_PolicyId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblpolicymaster: 4 rows
/*!40000 ALTER TABLE `tblpolicymaster` DISABLE KEYS */;
INSERT INTO `tblpolicymaster` (`a_PolicyId`, `t_PolicyName`, `n_MaxRptAmt`, `d_RptDueDt`, `d_RptDueDt1`, `n_MaxExpAmt`, `b_CashAdAllowed`, `b_RecpReq`, `n_AboveAmt`, `n_Days`, `n_MaxRptMilage`, `n_MilageRate`, `n_PerMeasuremnt`, `n_MaxExpMil`, `b_IsGPSReq`, `n_MonthlyExpLmt`, `n_DailyExpLmt`, `d_CreatedOn`, `n_CreatedBy`, `n_CreatedType`, `d_ModifiedOn`, `n_ModifiedBy`, `b_Deleted`, `n_BusinessId`, `n_AdminType`, `n_ReportDueBy`, `t_flagExpSubmitted`, `n_MilRateUnitValue`, `n_RptDueByValue`, `t_ModifiedByType`) VALUES
	(1, 'Common Policy', 5000.00, '0', '0', 2000.00, b'0', b'1', 1000.00, NULL, 200.00, 200.00, 1, 200.00, b'1', 10000.00, 500.00, NULL, 1, 1, NULL, 1, 0, 23, 33, NULL, '500', NULL, NULL, NULL),
	(2, 'Paintball Policy1', 50000.00, '0', '0', 1000.00, b'0', b'1', 1000.00, NULL, 5000.00, 10.00, 1, 10000.00, b'0', 50000.00, 5000.00, NULL, 1, 0, NULL, 0, 0, 24, 33, NULL, '20', NULL, NULL, NULL),
	(3, '', 0.00, '0', '0', 0.00, b'1', b'1', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 0, 0, -1, 33, NULL, '', NULL, NULL, NULL),
	(4, '', 0.00, '0', '0', 0.00, b'1', b'0', 0.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, 0, 0, 1, 33, NULL, '', NULL, NULL, NULL);
/*!40000 ALTER TABLE `tblpolicymaster` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblroleaccess
CREATE TABLE IF NOT EXISTS `tblroleaccess` (
  `a_RoleAccessId` int(254) NOT NULL AUTO_INCREMENT,
  `t_AccessName` varchar(50) NOT NULL,
  `d_CreatedOn` bigint(254) NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  `b_Deleted` bit(1) NOT NULL,
  `n_BusinessId` int(254) NOT NULL,
  `n_AdminType` int(254) NOT NULL,
  PRIMARY KEY (`a_RoleAccessId`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblroleaccess: 8 rows
/*!40000 ALTER TABLE `tblroleaccess` DISABLE KEYS */;
INSERT INTO `tblroleaccess` (`a_RoleAccessId`, `t_AccessName`, `d_CreatedOn`, `n_CreatedBy`, `d_ModifiedOn`, `n_ModifiedBy`, `b_Deleted`, `n_BusinessId`, `n_AdminType`) VALUES
	(1, 'Edit policy', 2014, 0, '0000-00-00 00:00:00', 0, b'0', 0, 33),
	(2, 'Edit Business', 2014, 0, '0000-00-00 00:00:00', 0, b'0', 0, 33),
	(3, 'Manage Employees', 2014, 0, '0000-00-00 00:00:00', 0, b'0', 0, 33),
	(4, 'View Sending Analysis', 2014, 0, '0000-00-00 00:00:00', 0, b'0', 0, 33),
	(5, 'Approved Expense report', 2014, 0, '0000-00-00 00:00:00', 0, b'0', 0, 33),
	(6, 'Manage Admins', 2014, 0, '0000-00-00 00:00:00', 0, b'0', 0, 33),
	(7, 'Approved Pre-Expense report', 2014, 0, '0000-00-00 00:00:00', 0, b'0', 0, 33),
	(8, 'Reimburse', 2014, 0, '0000-00-00 00:00:00', 0, b'0', 0, 33);
/*!40000 ALTER TABLE `tblroleaccess` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblrptnote
CREATE TABLE IF NOT EXISTS `tblrptnote` (
  `a_NoteId` bigint(20) NOT NULL AUTO_INCREMENT,
  `n_ReportId` bigint(20) NOT NULL,
  `t_NoteDesc` longtext NOT NULL,
  `d_CreatedOn` datetime DEFAULT NULL,
  `n_ModifiedBy` bigint(20) DEFAULT NULL,
  `b_Deleted` bit(1) NOT NULL,
  `n_CreatedBy` int(11) NOT NULL,
  `t_Type` enum('SystemAdmin','Admin','Employee') NOT NULL,
  `d_ModifiedOn` datetime DEFAULT NULL,
  PRIMARY KEY (`a_NoteId`)
) ENGINE=InnoDB AUTO_INCREMENT=189 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblrptnote: ~188 rows (approximately)
/*!40000 ALTER TABLE `tblrptnote` DISABLE KEYS */;
INSERT INTO `tblrptnote` (`a_NoteId`, `n_ReportId`, `t_NoteDesc`, `d_CreatedOn`, `n_ModifiedBy`, `b_Deleted`, `n_CreatedBy`, `t_Type`, `d_ModifiedOn`) VALUES
	(1, 11, 'etretr', NULL, NULL, b'0', 1, 'SystemAdmin', NULL),
	(2, 11, 'terter', NULL, NULL, b'0', 1, 'Admin', NULL),
	(3, 11, 'asdfasd', NULL, NULL, b'0', 1, 'Admin', NULL),
	(4, 11, 'asd', NULL, NULL, b'0', 2, 'Admin', NULL),
	(5, 11, 'asdas', NULL, NULL, b'0', 2, 'Employee', NULL),
	(6, 11, 'etretr', NULL, NULL, b'0', 0, 'Employee', NULL),
	(7, 11, 'terter', NULL, NULL, b'0', 0, '', NULL),
	(8, 11, 'asdfasd', NULL, NULL, b'0', 0, '', NULL),
	(9, 11, 'asd', NULL, NULL, b'0', 0, '', NULL),
	(10, 11, 'asdas', NULL, NULL, b'0', 0, '', NULL),
	(11, 11, 'barun', NULL, NULL, b'0', 0, '', NULL),
	(12, 11, 'kumar', NULL, NULL, b'0', 0, '', NULL),
	(13, 1, 'hhhh', NULL, 1, b'1', 1, 'Admin', '2014-11-17 13:23:31'),
	(14, 1, 'iiiiiiii', NULL, 1, b'1', 1, 'Admin', '2014-11-17 13:26:37'),
	(15, 1, 'nnnnnn', NULL, 1, b'1', 1, 'Admin', '2014-11-17 13:26:30'),
	(16, 1, 'hhhh', NULL, 1, b'1', 1, 'SystemAdmin', '2014-11-17 13:24:38'),
	(17, 1, 'iiiiiiii', NULL, 1, b'1', 0, '', '2014-11-17 15:34:42'),
	(18, 1, 'nnnnnn', NULL, NULL, b'0', 0, '', NULL),
	(19, 1, 'hhhh', NULL, 1, b'1', 0, '', '2014-11-17 15:36:06'),
	(20, 0, 'iiiiiiii', NULL, NULL, b'0', 0, '', NULL),
	(21, 0, 'nnnnnn', NULL, NULL, b'0', 0, '', NULL),
	(22, 58, 'hhhh', NULL, NULL, b'0', 0, '', NULL),
	(23, 58, 'iiiiiiii', NULL, NULL, b'0', 0, '', NULL),
	(24, 58, 'nnnnnn', NULL, NULL, b'0', 0, '', NULL),
	(25, 59, 'hhhh', NULL, NULL, b'0', 0, '', NULL),
	(26, 59, 'iiiiiiii', NULL, NULL, b'0', 0, '', NULL),
	(27, 59, 'nnnnnn', NULL, NULL, b'0', 0, '', NULL),
	(28, 60, 'test', NULL, NULL, b'0', 0, '', NULL),
	(29, 60, 'test1', NULL, NULL, b'0', 0, '', NULL),
	(30, 60, 'test2', NULL, NULL, b'0', 0, '', NULL),
	(31, 61, 'asdasd', NULL, NULL, b'0', 0, '', NULL),
	(32, 61, 'asdas', NULL, NULL, b'0', 0, '', NULL),
	(33, 62, 'asdasd', NULL, NULL, b'0', 0, '', NULL),
	(34, 62, 'asdas', NULL, NULL, b'0', 0, '', NULL),
	(35, 63, 'asdasd', NULL, NULL, b'0', 0, '', NULL),
	(36, 63, 'asdas', NULL, NULL, b'0', 0, '', NULL),
	(37, 64, 'asdasd', NULL, NULL, b'0', 0, '', NULL),
	(38, 64, 'asdas', NULL, NULL, b'0', 0, '', NULL),
	(39, 65, 'dasdas', NULL, NULL, b'0', 0, '', NULL),
	(40, 65, 'asdasd', NULL, NULL, b'0', 0, '', NULL),
	(41, 66, 'dasdas', NULL, NULL, b'0', 0, '', NULL),
	(42, 66, 'asdasd', NULL, NULL, b'0', 0, '', NULL),
	(43, 67, 'dasdas', NULL, NULL, b'0', 0, '', NULL),
	(44, 67, 'asdasd', NULL, NULL, b'0', 0, '', NULL),
	(45, 68, 'dasdas', NULL, NULL, b'0', 0, '', NULL),
	(46, 68, 'asdasd', NULL, NULL, b'0', 0, '', NULL),
	(47, 69, '', NULL, NULL, b'0', 0, '', NULL),
	(48, 70, '', NULL, NULL, b'0', 0, '', NULL),
	(49, 71, '', NULL, NULL, b'0', 0, '', NULL),
	(50, 72, '', NULL, NULL, b'0', 0, '', NULL),
	(51, 73, '', NULL, NULL, b'0', 0, '', NULL),
	(52, 74, '', NULL, NULL, b'0', 0, '', NULL),
	(53, 75, '', NULL, NULL, b'0', 0, '', NULL),
	(54, 76, '', NULL, NULL, b'0', 0, '', NULL),
	(55, 77, '', NULL, NULL, b'0', 0, '', NULL),
	(56, 78, '', NULL, NULL, b'0', 0, '', NULL),
	(57, 79, '', NULL, NULL, b'0', 0, '', NULL),
	(58, 80, '', NULL, NULL, b'0', 0, '', NULL),
	(59, 81, '', NULL, NULL, b'0', 0, '', NULL),
	(60, 82, '', NULL, NULL, b'0', 0, '', NULL),
	(61, 83, '', NULL, NULL, b'0', 0, '', NULL),
	(62, 1, 'fgjgkhk', '2014-11-16 16:00:27', 1, b'1', 1, 'Admin', '2014-11-17 13:26:57'),
	(63, 1, 'szfvdsvbfdbdfb', '2014-11-16 16:03:17', 1, b'1', 1, 'Admin', '2014-11-17 13:31:58'),
	(64, 1, 'sdnvjkdsbvjdsbvjsdvjkbsdkjvnksjdbvjsdbjkvsjd', '2014-11-16 16:27:57', 1, b'1', 1, 'Admin', '2014-11-17 13:32:20'),
	(65, 1, 'az dcnsc', '2014-11-16 16:28:39', 1, b'1', 1, 'Admin', '2014-11-17 13:32:53'),
	(66, 1, 'ndsvdjbvsdvkdnvjkdsvnsd', '2014-11-16 16:34:00', 1, b'1', 1, 'Admin', '2014-11-17 13:52:50'),
	(67, 1, 'skldvmosdpvdv', '2014-11-16 16:34:27', NULL, b'0', 1, 'Admin', NULL),
	(68, 1, 'abc', '2014-11-16 16:34:48', NULL, b'0', 1, 'Admin', NULL),
	(69, 1, 'sd', '2014-11-16 17:22:18', NULL, b'0', 1, 'Admin', NULL),
	(70, 1, 'df', '2014-11-16 17:22:54', NULL, b'0', 1, 'Admin', NULL),
	(71, 1, 'as', '2014-11-16 17:25:10', NULL, b'0', 1, 'Admin', NULL),
	(72, 1, 'fgfg', '2014-11-16 17:35:40', NULL, b'0', 1, 'Admin', NULL),
	(73, 1, 'bhgh', '2014-11-16 17:36:33', NULL, b'0', 1, 'Admin', NULL),
	(74, 1, 'hjj', '2014-11-16 17:36:46', NULL, b'0', 1, 'Admin', NULL),
	(75, 1, 'gfg', '2014-11-16 17:38:03', NULL, b'0', 1, 'Admin', NULL),
	(76, 1, 'dfdf', '2014-11-16 17:46:35', NULL, b'0', 1, 'Admin', NULL),
	(77, 1, 'gbhghgh', '2014-11-16 17:49:25', NULL, b'0', 1, 'Admin', NULL),
	(78, 1, 'ghgh', '2014-11-16 17:50:31', NULL, b'0', 1, 'Admin', NULL),
	(79, 1, 'klkk', '2014-11-16 17:51:38', NULL, b'0', 1, 'Admin', NULL),
	(80, 1, 'er', '2014-11-16 17:53:28', NULL, b'0', 1, 'Admin', NULL),
	(81, 1, 'rfgfg', '2014-11-16 17:56:48', NULL, b'0', 1, 'Admin', NULL),
	(82, 1, 'fgfg', '2014-11-16 17:57:05', NULL, b'0', 1, 'Admin', NULL),
	(83, 0, '', '2014-11-16 18:30:02', NULL, b'0', 1, 'Admin', NULL),
	(84, 1, 'szfvdsvbfdbdfb', '2014-11-17 09:45:13', NULL, b'0', 1, 'Admin', NULL),
	(85, 1, 'szfvdsvbfdbdfb', '2014-11-17 09:45:32', NULL, b'0', 1, 'Admin', NULL),
	(86, 0, '', '2014-11-17 10:39:49', NULL, b'0', 1, 'Admin', NULL),
	(87, 1, 'def', '2014-11-17 10:42:03', NULL, b'0', 1, 'Admin', NULL),
	(88, 1, 'as', '2014-11-17 10:43:47', NULL, b'0', 1, 'Admin', NULL),
	(89, 0, '', '2014-11-17 11:24:40', NULL, b'0', 1, 'Admin', NULL),
	(90, 1, 'weq', '2014-11-17 11:30:41', NULL, b'0', 1, 'Admin', NULL),
	(91, 1, 'xyz', '2014-11-17 12:10:22', NULL, b'0', 1, 'Admin', NULL),
	(92, 1, 'launcher', '2014-11-17 13:42:15', NULL, b'0', 1, 'Admin', NULL),
	(93, 1, 'asfdsfdg', '2014-11-17 13:43:29', NULL, b'0', 1, 'Admin', NULL),
	(94, 1, 'qwe', '2014-11-17 13:45:40', NULL, b'0', 1, 'Admin', NULL),
	(95, 1, 'fdg', '2014-11-17 13:46:53', NULL, b'0', 1, 'Admin', NULL),
	(96, 1, 'qewqdfwec', '2014-11-17 13:54:21', NULL, b'0', 1, 'Admin', NULL),
	(97, 1, 'asdsfsf', '2014-11-17 15:33:07', NULL, b'0', 1, 'Admin', NULL),
	(98, 1, 'hjkljmn', '2014-11-17 15:34:39', NULL, b'0', 1, 'Employee', NULL),
	(99, 1, 'awer', '2014-11-17 15:35:58', 1, b'1', 1, 'Admin', '2014-11-17 15:36:02'),
	(100, 1, 'launcher', '2014-11-17 16:49:58', NULL, b'0', 1, 'Admin', NULL),
	(101, 84, 'fhh', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(102, 85, 'fhh', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(103, 84, 'dfhdfh', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(104, 85, 'dfhdfh', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(105, 86, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(106, 87, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(107, 88, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(108, 89, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(109, 90, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(110, 91, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(111, 93, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(112, 92, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(113, 94, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(114, 95, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(115, 96, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(116, 97, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(117, 98, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(118, 99, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(119, 100, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(120, 101, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(121, 102, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(122, 103, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(123, 104, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(124, 105, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(125, 1, '', '2014-11-19 13:17:47', 1, b'1', 1, 'Admin', '2014-11-19 13:19:02'),
	(126, 1, '', '2014-11-19 13:18:29', 1, b'1', 1, 'Admin', '2014-11-19 13:19:01'),
	(127, 1, ' hgjhj', '2014-11-19 13:18:57', NULL, b'0', 1, 'Admin', NULL),
	(128, 106, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(129, 107, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(130, 108, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(131, 108, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(132, 109, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(133, 109, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(134, 110, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(135, 111, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(136, 110, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(137, 111, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(138, 112, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(139, 113, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(140, 112, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(141, 113, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(142, 114, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(143, 114, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(144, 115, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(145, 115, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(146, 116, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(147, 116, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(148, 117, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(149, 117, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(150, 118, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(151, 118, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(152, 119, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(153, 119, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(154, 121, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(155, 121, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(156, 120, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(157, 120, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(158, 122, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(159, 122, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(160, 123, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(161, 123, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(162, 124, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(163, 124, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(164, 125, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(165, 125, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(166, 127, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(167, 127, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(168, 126, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(169, 126, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(170, 129, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(171, 129, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(172, 128, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(173, 128, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(174, 130, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(175, 131, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(176, 132, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(177, 133, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(178, 134, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(179, 135, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(180, 136, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(181, 137, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(182, 138, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(183, 139, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(184, 140, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(185, 143, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(186, 145, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(187, 147, '', NULL, NULL, b'0', 0, 'SystemAdmin', NULL),
	(188, 1, 'testing', '2014-11-20 14:30:51', NULL, b'0', 2, 'Admin', NULL);
/*!40000 ALTER TABLE `tblrptnote` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblsettingtype
CREATE TABLE IF NOT EXISTS `tblsettingtype` (
  `a_EnumId` int(254) NOT NULL AUTO_INCREMENT,
  `t_EnumTypeDescription` varchar(50) NOT NULL,
  `t_EnumKey` varchar(100) NOT NULL,
  `b_ForAll` bit(1) NOT NULL,
  `d_CreatedOn` bigint(254) NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  `b_IsActive` bit(1) NOT NULL,
  `n_BusinessId` int(254) NOT NULL,
  `n_AdminType` int(254) NOT NULL,
  PRIMARY KEY (`a_EnumId`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblsettingtype: 6 rows
/*!40000 ALTER TABLE `tblsettingtype` DISABLE KEYS */;
INSERT INTO `tblsettingtype` (`a_EnumId`, `t_EnumTypeDescription`, `t_EnumKey`, `b_ForAll`, `d_CreatedOn`, `n_CreatedBy`, `d_ModifiedOn`, `n_ModifiedBy`, `b_IsActive`, `n_BusinessId`, `n_AdminType`) VALUES
	(1, 'for currency table', 'currency', b'1', 2014, 1, '0000-00-00 00:00:00', 0, b'1', 10, 33),
	(2, 'cgfchg', 'cghcgh', b'1', 2014, 1, '0000-00-00 00:00:00', 0, b'1', 10, 33),
	(3, 'cgfchg', 'cghcgh', b'1', 2014, 1, '0000-00-00 00:00:00', 0, b'1', 10, 33),
	(4, 'Distance Measure', 'dis_mea', b'1', 2014, 1, '0000-00-00 00:00:00', 0, b'1', 0, 33),
	(5, 'Billing Type', 'bill_type', b'1', 2014, 1, '0000-00-00 00:00:00', 0, b'1', 0, 33),
	(6, 'Package', 'package', b'1', 2014, 1, '0000-00-00 00:00:00', 0, b'1', 0, 33);
/*!40000 ALTER TABLE `tblsettingtype` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblsettingvalue
CREATE TABLE IF NOT EXISTS `tblsettingvalue` (
  `a_SettingId` int(254) NOT NULL AUTO_INCREMENT,
  `t_SettingValue` varchar(255) NOT NULL,
  `n_EnumId` int(11) NOT NULL,
  `n_ValueId` int(10) NOT NULL,
  `n_Priority` int(10) NOT NULL,
  `n_CreatedOn` datetime NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `n_modifiedOn` datetime NOT NULL,
  `n_modifiedBy` bigint(254) NOT NULL,
  `b_IsActive` bit(1) NOT NULL,
  `n_BusinessId` int(254) NOT NULL,
  `n_AdminType` int(254) NOT NULL,
  PRIMARY KEY (`a_SettingId`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblsettingvalue: ~14 rows (approximately)
/*!40000 ALTER TABLE `tblsettingvalue` DISABLE KEYS */;
INSERT INTO `tblsettingvalue` (`a_SettingId`, `t_SettingValue`, `n_EnumId`, `n_ValueId`, `n_Priority`, `n_CreatedOn`, `n_CreatedBy`, `n_modifiedOn`, `n_modifiedBy`, `b_IsActive`, `n_BusinessId`, `n_AdminType`) VALUES
	(1, 'vghf', 2, 1, 1, '2014-10-31 19:53:47', 1, '0000-00-00 00:00:00', 0, b'1', 10, 33),
	(2, 'vghf', 2, 2, 2, '2014-10-31 19:53:47', 1, '0000-00-00 00:00:00', 0, b'1', 10, 33),
	(3, 'vghf', 3, 3, 3, '2014-10-31 19:55:06', 1, '0000-00-00 00:00:00', 0, b'1', 10, 33),
	(5, 'FM', 0, 2, 5, '2014-11-01 11:25:42', 0, '0000-00-00 00:00:00', 0, b'1', 0, 33),
	(37, 'KM', 4, 27, 30, '2014-11-21 11:04:38', 0, '0000-00-00 00:00:00', 0, b'1', 0, 33),
	(38, 'MM', 4, 28, 31, '2014-11-21 11:04:53', 0, '2014-11-21 11:05:02', 0, b'1', 0, 33),
	(39, 'CM', 4, 29, 32, '2014-11-21 11:05:09', 0, '0000-00-00 00:00:00', 0, b'1', 0, 33),
	(40, 'Monthly Per Employee', 5, 30, 33, '2014-11-21 11:06:18', 0, '0000-00-00 00:00:00', 0, b'1', 0, 33),
	(41, 'Per Report', 5, 31, 34, '2014-11-21 11:06:33', 0, '0000-00-00 00:00:00', 0, b'1', 0, 33),
	(42, 'Trial', 5, 32, 35, '2014-11-21 11:06:41', 0, '0000-00-00 00:00:00', 0, b'1', 0, 33),
	(43, 'Basic', 6, 33, 36, '2014-11-21 11:07:46', 0, '0000-00-00 00:00:00', 0, b'1', 0, 33),
	(44, 'Standard', 6, 34, 37, '2014-11-21 11:07:57', 0, '0000-00-00 00:00:00', 0, b'1', 0, 33),
	(45, 'Premium', 6, 35, 38, '2014-11-21 11:08:06', 0, '0000-00-00 00:00:00', 0, b'1', 0, 33),
	(46, 'Custom', 6, 36, 39, '2014-11-21 11:08:15', 0, '0000-00-00 00:00:00', 0, b'1', 0, 33);
/*!40000 ALTER TABLE `tblsettingvalue` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblspndngcat
CREATE TABLE IF NOT EXISTS `tblspndngcat` (
  `a_SpndngCatId` int(254) NOT NULL AUTO_INCREMENT,
  `t_SpndName` varchar(50) DEFAULT NULL,
  `t_GLCode` varchar(20) DEFAULT NULL,
  `d_CreatedOn` bigint(254) NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  `b_IsActive` bit(1) DEFAULT NULL,
  `b_Deleted` bit(1) DEFAULT b'0',
  `n_BusinessId` int(254) NOT NULL,
  `n_AdminType` int(254) NOT NULL,
  PRIMARY KEY (`a_SpndngCatId`),
  UNIQUE KEY `t_SpndName` (`t_SpndName`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblspndngcat: 26 rows
/*!40000 ALTER TABLE `tblspndngcat` DISABLE KEYS */;
INSERT INTO `tblspndngcat` (`a_SpndngCatId`, `t_SpndName`, `t_GLCode`, `d_CreatedOn`, `n_CreatedBy`, `d_ModifiedOn`, `n_ModifiedBy`, `b_IsActive`, `b_Deleted`, `n_BusinessId`, `n_AdminType`) VALUES
	(1, '', '', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'1', 2, 33),
	(2, 'deepesh', '34242', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'1', 2, 33),
	(3, 'fgfgg', '453', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'1', 2, 33),
	(4, 'dfgfg', '453234', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'1', 2, 33),
	(5, 'klklk', '111111', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'1', 2, 33),
	(6, 'dfsds', 'fsdfsf', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'1', 2, 33),
	(7, 'gdfgfd', 'dgffdg', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'1', 2, 33),
	(8, 'cvbcb', 'vbcvb', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'1', 2, 33),
	(9, 'dfsf', 'fdss', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'1', 2, 33),
	(10, 'dc', 'dc', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'1', 2, 33),
	(11, 'gdfgd', 'dgdfg', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'1', 1, 1),
	(12, 'gdgf', 'dgfdg', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'1', 1, 1),
	(13, 'dff', 'fds', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'1', 1, 1),
	(14, 'c', '44', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'0', 23, 1),
	(15, 'asdfa', 'asdfa', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'0', 23, 33),
	(16, 'dfsdf', 'fff', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'0', 23, 33),
	(17, 'ff', '111111', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'0', 23, 33),
	(18, 'fgfgfgf', '4353', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'0', 23, 33),
	(19, 'sasasdas', 'fdfsfsf', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'0', 23, 1),
	(20, 'travel', 'sdfsdfsd', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'0', 23, 1),
	(21, 'food', 'dfd', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'0', 23, 1),
	(22, 'cc', 'cc', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'1', 1, 33),
	(23, 'cds', 'xzczxczxx', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'1', 1, 1),
	(24, 'New Category 1', 's', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'0', 2, 1),
	(25, 'New Category 2', 's', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'0', 2, 1),
	(26, 'New category 3', 's', 2014, 1, '0000-00-00 00:00:00', 0, NULL, b'0', 2, 1);
/*!40000 ALTER TABLE `tblspndngcat` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblstate
CREATE TABLE IF NOT EXISTS `tblstate` (
  `a_StateId` int(254) NOT NULL AUTO_INCREMENT,
  `n_CountryId` int(11) NOT NULL,
  `t_StateName` varchar(50) NOT NULL,
  `d_CreatedOn` datetime NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  `b_IsActive` bit(1) DEFAULT NULL,
  `n_BusinessId` int(254) NOT NULL,
  `n_AdminType` int(254) NOT NULL,
  PRIMARY KEY (`a_StateId`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblstate: 3 rows
/*!40000 ALTER TABLE `tblstate` DISABLE KEYS */;
INSERT INTO `tblstate` (`a_StateId`, `n_CountryId`, `t_StateName`, `d_CreatedOn`, `n_CreatedBy`, `d_ModifiedOn`, `n_ModifiedBy`, `b_IsActive`, `n_BusinessId`, `n_AdminType`) VALUES
	(5, 1, 'New Delhi', '2014-11-21 11:01:40', 0, '2014-11-21 11:01:40', 0, b'1', 0, 33),
	(2, 1, 'Maharastra', '2014-11-21 01:47:40', 0, '2014-11-21 11:02:03', 0, b'1', 0, 33),
	(6, 1, 'Haryana', '2014-11-21 11:09:51', 0, '2014-11-21 11:09:51', 0, b'1', 0, 33);
/*!40000 ALTER TABLE `tblstate` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tblsysadmin
CREATE TABLE IF NOT EXISTS `tblsysadmin` (
  `a_SysAdminId` int(254) NOT NULL AUTO_INCREMENT,
  `t_AdminCode` varchar(20) NOT NULL,
  `t_FirstName` varchar(50) NOT NULL,
  `t_LastName` varchar(50) NOT NULL,
  `n_CityId` int(11) DEFAULT NULL,
  `n_StateId` int(11) DEFAULT NULL,
  `t_Address` varchar(300) DEFAULT NULL,
  `t_Email` varchar(50) DEFAULT NULL,
  `d_CreatedOn` datetime NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  PRIMARY KEY (`a_SysAdminId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tblsysadmin: 0 rows
/*!40000 ALTER TABLE `tblsysadmin` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblsysadmin` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tbl_businessadmin
CREATE TABLE IF NOT EXISTS `tbl_businessadmin` (
  `a_BusnAdminId` int(254) NOT NULL AUTO_INCREMENT,
  `t_AdminCode` varchar(50) NOT NULL,
  `t_FirstName` varchar(50) NOT NULL,
  `t_LastName` varchar(50) DEFAULT NULL,
  `n_CountryId` int(100) DEFAULT NULL,
  `n_CityId` int(100) DEFAULT NULL,
  `n_StateId` int(100) DEFAULT NULL,
  `tba_Address` varchar(300) DEFAULT NULL,
  `t_Contact` varchar(20) DEFAULT NULL,
  `t_Email` varchar(50) DEFAULT NULL,
  `t_password` varchar(200) DEFAULT NULL,
  `d_DOB` datetime DEFAULT NULL,
  `n_Positon` varchar(50) DEFAULT NULL,
  `n_AdminType` int(11) DEFAULT NULL,
  `d_CreatedOn` bigint(254) NOT NULL,
  `n_CreatedBy` bigint(254) NOT NULL,
  `d_ModifiedOn` datetime NOT NULL,
  `n_ModifiedBy` bigint(254) NOT NULL,
  `b_Deleted` bit(1) DEFAULT NULL,
  `n_BusinessId` int(11) DEFAULT NULL,
  `t_Pincode` varchar(45) DEFAULT NULL,
  `t_Mobile` varchar(45) DEFAULT NULL,
  `n_DeptId` int(11) DEFAULT NULL,
  `n_seqcode` varchar(255) NOT NULL,
  `b_Status` bit(1) DEFAULT NULL,
  `t_Type` enum('SystemAdmin','BusinessAdmin') NOT NULL,
  PRIMARY KEY (`a_BusnAdminId`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tbl_businessadmin: 30 rows
/*!40000 ALTER TABLE `tbl_businessadmin` DISABLE KEYS */;
INSERT INTO `tbl_businessadmin` (`a_BusnAdminId`, `t_AdminCode`, `t_FirstName`, `t_LastName`, `n_CountryId`, `n_CityId`, `n_StateId`, `tba_Address`, `t_Contact`, `t_Email`, `t_password`, `d_DOB`, `n_Positon`, `n_AdminType`, `d_CreatedOn`, `n_CreatedBy`, `d_ModifiedOn`, `n_ModifiedBy`, `b_Deleted`, `n_BusinessId`, `t_Pincode`, `t_Mobile`, `n_DeptId`, `n_seqcode`, `b_Status`, `t_Type`) VALUES
	(1, 'ddd', '11', '11', 1, 1, 1, 'xx', 'vcxx', 'rakesh@gmail.com', '96e79218965eb72c92a549dd5a330112', '2014-11-18 16:48:42', '1', 1, 2014, 1, '0000-00-00 00:00:00', 0, b'0', 1, NULL, NULL, 1, '', b'1', 'SystemAdmin'),
	(12, 'p_Busineescode', 'True Expense User', 'Test User', 1, 1, 1, 'test1%test1', 'test1', 'testuser@gmail.com', '96e79218965eb72c92a549dd5a330112', '1970-01-01 00:00:00', '0sdfsd', 4, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 12, NULL, NULL, NULL, '', b'1', 'SystemAdmin'),
	(2, 'test', 'RAHUl', 'YADAV', 5, 0, 0, 'SAGARPUR%MOHAN NAGAR%D-BLOCK', '011454578', 'rahul@mindztechnology.com', '96e79218965eb72c92a549dd5a330112', '2014-11-01 00:00:00', '5679', 4, 2014, 1, '2014-11-16 17:51:52', 0, b'1', 2, '110058     ', '9715754875', 1, ' SHEETESH1 ', b'1', 'SystemAdmin'),
	(3, '12', 'RAMBHA', 'DUBEY', 1, 1, 1, 'address1___address2_', '0112477854', NULL, NULL, '2014-11-13 00:00:00', 'null', 0, 2014, 0, '0000-00-00 00:00:00', 0, b'1', 2, '110025', '1212121211', 1, '', b'1', 'SystemAdmin'),
	(5, 'rer', 'RITU', 'VERMA', 5, 1, 2, NULL, '9555545444', 'sheetesh@india.com', '00c1de56b1cbab48f9869c1460d70e76', '2014-11-19 00:00:00', 'v', 33, 0, 1, '2014-11-28 00:00:00', 1, b'1', 2, '111111', '1111111111', 2, 'dddd', b'1', 'SystemAdmin'),
	(6, 'test', 'Rahul', 'Yadav', 1, 1, 1, 'Address Line1%aaAddress Line2', '65464564564', 'rahul@gmail.com', '0103865cf8242d2fcbd708d9ed8fab02', '2014-11-26 00:00:00', '66', 33, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 6, NULL, NULL, NULL, '', b'1', 'SystemAdmin'),
	(7, 'test', 'Rahul', 'Yadav', 1, 1, 1, 'Address Line1%aaAddress Line2', '65464564564', 'rahul@gmail.com', '8ef9b01e1d697bb9c80af4fe96e42231', '2014-11-26 00:00:00', '66', 33, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 7, NULL, NULL, NULL, '', b'1', 'SystemAdmin'),
	(8, 'test', 'Rahul', 'Yadav', 1, 1, 1, 'Address Line1%aaAddress Line2', '65464564564', 'rahul2@gmail.com', '30b06ce46bc96bd2f24c3580b37ce6fa', '2014-11-26 00:00:00', '66', 33, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 8, NULL, NULL, NULL, '', b'1', 'SystemAdmin'),
	(9, 'test', 'Deepesh', 'singh', 12, 5, 7, 'addredss%address', 'sadfgas', 'deepesh@mindz.com', 'edae759a5c220b1d9e4a7201e0c36678', '2014-11-19 00:00:00', '0', 4, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 9, NULL, NULL, NULL, '', b'1', 'SystemAdmin'),
	(10, 'p_Busineescode', 'SHEETESH', 'DUBEY', 2, 2, 2, 'SAGARPUR%GANDHI MARKET', '9857487574', 'sheetesh@india.com1', '7536d64d440971ccf1b23f5c3f8894d4', '1991-07-20 00:00:00', '4455', 4, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 10, NULL, NULL, NULL, '', b'1', 'SystemAdmin'),
	(11, 'p_Busineescode', 'nmnnnn1', 'lastname1', 2, 2, 2, 'Address Line11%Address Line21', '456456', 'fsf@dsdf.com1', '3fed9447da05dc882abe39e219f2309e', '2014-11-28 00:00:00', 'gdfgddfgdfgd fg', 4, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 11, NULL, NULL, NULL, '', b'1', 'SystemAdmin'),
	(13, 'p_Busineescode', 'appfirstvame', 'applastname', 1, 1, 1, 'Address Line1%aaAddress Line2', '45645645645', 'bulling@gmail.com', 'a95c5b2b17a49d372e3570f81070d1c5', '1970-01-01 00:00:00', 'dfgdfgdfg', 4, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 13, NULL, NULL, NULL, '', b'1', 'SystemAdmin'),
	(14, 'p_Busineescode', 'reter tert ertre', 't retert ert erwt', 1, 1, 1, 'er tertertert%er tertert ert', '45435345', 'billingInformation@gmail.com', 'ed55dca4180a779241171273142cc396', '2014-11-30 00:00:00', 'df gdfgdfgs', 4, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 14, NULL, NULL, NULL, '', b'1', 'SystemAdmin'),
	(15, 'azhar001', 'Azhar', 'Ahmad', 1, 1, 1, 'sdfvdsgvdsv___nbdsjhvsbdvb', 'dsgdrsgdrg', 'azhar@gmail.com', '96e79218965eb72c92a549dd5a330112', NULL, '2', 33, 2014, 1, '0000-00-00 00:00:00', 0, b'0', 1, '151555', '1654484', 1, '', b'1', 'SystemAdmin'),
	(23, 'p_Busineescode', 'Creative', 'professionals', 1, 1, 1, 'Address Line22%Address Line22', 'Billing Contact', 'creative@gmail.com', '96e79218965eb72c92a549dd5a330112', '2014-11-21 00:00:00', 'SEO', 4, 2014, 1, '0000-00-00 00:00:00', 0, b'0', 22, NULL, NULL, NULL, '', b'1', 'SystemAdmin'),
	(17, 'p_Busineescode', 'fgdgasfasfs', 'asdfasdfsadf sfasdf', 1, 1, 1, 'aAddress Line1%aAddress Line21', '436456456', 'billingInformation@gmail.com', 'd0636e96e115c8252668d8c81d9cfbd5', '2014-11-30 00:00:00', '5679', 4, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 16, NULL, NULL, NULL, '', b'1', 'SystemAdmin'),
	(18, 'p_Busineescode', 'fgdgasfasfs', 'asdfasdfsadf sfasdf', 1, 1, 1, 'aAddress Line1%aAddress Line21', '436456456', 'billingInformation@gmail.com', 'fe6631a0ba6b174d9e1a3e0ea8a731c6', '2014-11-30 00:00:00', '5679', 4, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 17, NULL, NULL, NULL, '', b'1', 'SystemAdmin'),
	(19, 'p_Busineescode', 'fgdgasfasfs', 'asdfasdfsadf sfasdf', 1, 1, 1, 'aAddress Line1%aAddress Line21', '436456456', 'billingInformation@gmail.com', '77c83d6a8f0511d7e1a57599939b4558', '2014-11-30 00:00:00', '5679', 4, 2014, 1, '0000-00-00 00:00:00', 0, b'0', 18, NULL, NULL, NULL, '', b'1', 'SystemAdmin'),
	(20, 'p_Busineescode', 'depesh', 'singh', 1, 1, 1, 'this is the adress%this is the address', 'Billing Contact', 'google@gmail.com', 'fce59b5b822fe658e97c17f8b3dc039d', '2014-11-19 00:00:00', 'CEO', 4, 2014, 1, '0000-00-00 00:00:00', 0, b'0', 19, NULL, NULL, NULL, 'aaaa', b'1', 'SystemAdmin'),
	(21, 'p_Busineescode', 'fgdgasfasfs', 'aLast Name', 1, 1, 1, 'asdfasdfasfa11%aAddress Line21', '666666666', 'billingInformation@gmail.com', '698d51a19d8a121ce581499d7b701668', '2014-11-28 00:00:00', 'df gdfgdfgs', 4, 2014, 1, '0000-00-00 00:00:00', 0, b'1', 20, NULL, NULL, NULL, 'aaa', b'1', 'SystemAdmin'),
	(22, 'test', 'Deepesh', 'singh', 1, 1, 1, 'this is the address%this is the address', '999067303', 'wd.deepesh@gmail.com', '96e79218965eb72c92a549dd5a330112', '2014-11-19 00:00:00', 'CEO', 22, 2014, 1, '0000-00-00 00:00:00', 0, b'0', 21, NULL, NULL, NULL, '', b'1', 'SystemAdmin'),
	(24, '45', 'sdfvsdegdfbgbrrdbrbbdf', 'dvsdvsd', 1, 1, 1, 'dgdsgdg%dgrgrg___d', '45464', NULL, NULL, '2014-11-14 00:00:00', 'null', 0, 2014, 15, '2014-11-20 17:48:14', 15, b'0', 1, '4565', '654645', 1, '', b'1', 'SystemAdmin'),
	(25, '123123', 'Deepesh', 'singh', 2, 2, 2, 'fasfs%asdfas___dfa', '9990617303', 'creativepro@gmail.com', '96e79218965eb72c92a549dd5a330112', '2014-11-21 00:00:00', 'null', 0, 2014, 23, '0000-00-00 00:00:00', 0, b'0', 22, '110011', '9990617303', 1, '', b'1', 'SystemAdmin'),
	(26, 'test', 'jivo123', 'singh', 1, 1, 1, 'fasfs%asdfas___dfa', '9990617303', 'jivo@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '2014-11-28 00:00:00', 'CEO', 22, 2014, 1, '0000-00-00 00:00:00', 0, b'0', 23, NULL, NULL, NULL, '', b'1', 'SystemAdmin'),
	(27, '121', 'first name', 'last name', 1, 1, 1, 'fasfs%asdfas___dfa', '9990617303', 'jivopro@gmail.com', '96e79218965eb72c92a549dd5a330112', '2014-11-21 00:00:00', 'null', 33, 2014, 26, '0000-00-00 00:00:00', 0, b'0', 23, '1111111', '9990617303', 2, '', b'1', 'SystemAdmin'),
	(28, 'dvd@gmail.com', 'sdv', 'dbhfb', 1, 1, 1, 'hsdcdsc%sbfjsdbf__12312', '15616316', 'zsvfdv', 'b366e33cd37f1326eec87240432209e9', '2014-11-12 00:00:00', 'null', 33, 2014, 15, '0000-00-00 00:00:00', 0, b'0', 1, '236461', '546456', 2, '', b'1', 'SystemAdmin'),
	(29, 'ef', 'ferferv', 'sfefe', 1, 1, 1, 'efge', '43543543', 'sefef', 'efefe', '0000-00-00 00:00:00', 'null', 33, 2014, 215, '0000-00-00 00:00:00', 0, b'0', 1, '4543', '453454', 1, '', b'1', 'SystemAdmin'),
	(30, 'mind00_3', 'xyz', 'Ahmad', 1, 1, 1, 'hsdcdsc%safcvv%sfvsd', '15616316', 'email@email.com', '2d2c8394e31101a261abf1784302bf75', '2014-11-19 00:00:00', 'null', 33, 2014, 15, '2014-11-21 07:32:15', 15, b'0', 1, '236461', '1', 1, '', b'1', 'SystemAdmin'),
	(31, 'p_Busineescode', 'Anant', 'Sharma', 1, 5, 6, 'Shushant Lok%Udyog Vihar', '1234567890', 'admin@paintball.com', '96e79218965eb72c92a549dd5a330112', '2014-05-01 00:00:00', 'Administrator', 4, 2014, 1, '0000-00-00 00:00:00', 0, b'0', 24, NULL, NULL, NULL, '', b'1', 'SystemAdmin'),
	(32, 'test', 'Google', 'google', 1, 3, 5, 'alsdfj%lkasfjdlk', '9990617303', 'google@gmail.com', '96e79218965eb72c92a549dd5a330112', '2014-11-27 00:00:00', 'CEO', 22, 2014, 1, '0000-00-00 00:00:00', 0, b'0', 25, NULL, NULL, NULL, '', b'1', 'SystemAdmin');
/*!40000 ALTER TABLE `tbl_businessadmin` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tbl_menu
CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `a_MenuId` int(11) NOT NULL AUTO_INCREMENT,
  `t_menuname` varchar(100) NOT NULL,
  `n_ParentId` int(11) NOT NULL,
  `t_url` varchar(255) NOT NULL,
  `Is_Active` enum('Active','Deactive','Delete') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`a_MenuId`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tbl_menu: ~31 rows (approximately)
/*!40000 ALTER TABLE `tbl_menu` DISABLE KEYS */;
INSERT INTO `tbl_menu` (`a_MenuId`, `t_menuname`, `n_ParentId`, `t_url`, `Is_Active`) VALUES
	(1, 'Business', 1, 'ssa/business/business_add/', 'Active'),
	(2, 'Transactions', 1, 'ssa/superadmin/transactions', 'Active'),
	(3, 'Claim Reports', 1, 'ssa/claimreport', 'Active'),
	(4, 'Policy', 1, 'ssa/policy/policylist', 'Active'),
	(5, 'Employee', 1, 'ssa/employee/employeelock/', 'Active'),
	(6, 'Business Admins', 1, 'ssa/business/business_list/', 'Active'),
	(7, 'System Admins', 1, 'ssa/superadmin/superadminAdd/', 'Active'),
	(8, 'Spending Analysis', 1, 'ssa/superadmin/spend', 'Active'),
	(9, 'Profile', 1, 'ssa/superadmin/profile', 'Active'),
	(10, 'Notification', 1, 'ssa/superadmin/notification', 'Active'),
	(11, 'Claim Reports', 2, 'business/dashboard/claimReportList', 'Active'),
	(12, 'Policy', 2, 'business/dashboard/policy', 'Active'),
	(13, 'Business', 2, 'no Url', 'Active'),
	(14, 'Employees', 2, 'business/dashboard/employee/', 'Active'),
	(15, 'Admins', 2, 'business/dashboard/businessAdminListing', 'Active'),
	(16, 'Profile', 2, 'business/dashboard2/profile', 'Active'),
	(17, 'Spending Analysis', 2, 'business/dashboard2/spend', 'Active'),
	(18, 'Notification', 2, 'business/dashboard2/notification', 'Active'),
	(19, 'Help', 2, 'business/dashboard2/help', 'Active'),
	(20, 'T&C', 2, 'business/dashboard2/terms', 'Active'),
	(21, 'Claim Reports', 3, 'employee/claim', 'Active'),
	(22, 'Policy', 3, 'employee/policy', 'Active'),
	(23, 'Profile', 3, 'employee/profile', 'Active'),
	(24, 'Notification', 3, 'employee/notification', 'Active'),
	(25, 'Help', 3, 'employee/help', 'Active'),
	(26, 'T&C', 3, 'employee/terms', 'Active'),
	(30, 'Employees1', 2, 'business/dashboard/employee/', 'Active'),
	(32, 'Help', 1, 'ssa/superadmin/help', 'Active'),
	(33, 'T & C', 1, 'ssa/superadmin/terms', 'Active'),
	(45, 'Settings', 1, 'ssa/admin/setting/', 'Active'),
	(46, 'business 2', 2, 'business/dashboard2/bus_general/', 'Active');
/*!40000 ALTER TABLE `tbl_menu` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tbl_submenu
CREATE TABLE IF NOT EXISTS `tbl_submenu` (
  `a_SubmenuId` int(11) NOT NULL AUTO_INCREMENT,
  `n_MenuId` int(11) NOT NULL,
  `n_submenuid` int(100) NOT NULL,
  `n_userid` int(100) NOT NULL,
  `Is_Active` enum('Active','Deactive','Delete') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`a_SubmenuId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tbl_submenu: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_submenu` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_submenu` ENABLE KEYS */;


-- Dumping structure for table trueexpence.tbl_systemlogin
CREATE TABLE IF NOT EXISTS `tbl_systemlogin` (
  `a_SysloginId` int(11) NOT NULL AUTO_INCREMENT,
  `t_AdminCode` varchar(255) NOT NULL,
  `a_SysAdminId` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `n_CityId` int(11) NOT NULL,
  `n_StateId` int(11) NOT NULL,
  `t_Address` varchar(255) NOT NULL,
  `t_Email` varchar(255) NOT NULL,
  `t_username` varchar(100) NOT NULL,
  `t_password` varchar(100) NOT NULL,
  `d_createdon` datetime NOT NULL,
  `n_createdby` int(11) NOT NULL,
  `d_modifiedon` datetime NOT NULL,
  `n_modifiedby` int(11) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `n_sec_answ` char(200) NOT NULL,
  `IsActive` enum('Active','Deactive','Delete') NOT NULL DEFAULT 'Active',
  `b_Deleted` bit(1) DEFAULT b'0',
  PRIMARY KEY (`a_SysloginId`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

-- Dumping data for table trueexpence.tbl_systemlogin: ~15 rows (approximately)
/*!40000 ALTER TABLE `tbl_systemlogin` DISABLE KEYS */;
INSERT INTO `tbl_systemlogin` (`a_SysloginId`, `t_AdminCode`, `a_SysAdminId`, `firstName`, `lastName`, `n_CityId`, `n_StateId`, `t_Address`, `t_Email`, `t_username`, `t_password`, `d_createdon`, `n_createdby`, `d_modifiedon`, `n_modifiedby`, `lastlogin`, `n_sec_answ`, `IsActive`, `b_Deleted`) VALUES
	(1, '', '33', 'Admin', 'Admin', 1, 1, 'SAGARPUR*&MOHAN; NAGAR', '', 'admin@gmail.com', '96e79218965eb72c92a549dd5a330112', '0000-00-00 00:00:00', 0, '2014-11-21 17:59:34', 1, '2014-11-21 17:59:34', 'sheetesh', 'Active', b'0'),
	(2, '', '33', 'Deepesh', 'Singh', 0, 0, '0', '', 'rahul@mindztechnology.com', '51d9b501a973e2973610d999dd572101', '2014-11-07 12:25:37', 1, '2014-11-21 03:54:43', 1, '2014-11-21 03:54:43', 'aaaa', 'Active', b'0'),
	(3, '', '33', 'deepesh', 'singh', 0, 0, '0', '', 'wd.deepesh@gmail.co', '6886badb36b23129002bbbae0d9432d0', '2014-11-10 17:16:06', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '', 'Active', b'0'),
	(4, '', '33', 'deepesh', 'singh', 0, 0, '0', '', 'deepesh@mindztechn.com', '6886badb36b23129002bbbae0d9432d0', '2014-11-10 17:16:39', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '', 'Delete', b'0'),
	(5, '', '33', 'deepesh', 'singh', 0, 0, '0', '', 'deepesh@mindztechn.comm', '6886badb36b23129002bbbae0d9432d0', '2014-11-10 17:17:03', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '', 'Deactive', b'0'),
	(6, '', '33', 'asdfkl', 'klasdfkl', 0, 0, '0', '', 'dfas@gmail.com', '94bddd52e6d5de5fcc51f53d3c58383a', '2014-11-10 17:20:51', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '', 'Delete', b'0'),
	(7, '', '33', 'sheetesh', 'Dubey', 0, 0, '0', '', 'sheetesh@india.com', '7fa8282ad93047a4d6fe6111c93b308a', '2014-11-10 17:51:50', 1, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '', 'Delete', b'0'),
	(8, '', '33', 'sunny', 'Dubey', 0, 0, '0', '', 'sheetesh@in.com', 'e10adc3949ba59abbe56e057f20f883e', '2014-11-10 17:54:37', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 'Active', b'0'),
	(9, '', '33', 'sunny', 'Dubey', 0, 0, '0', '', 'sheetesh1@in.com', 'e10adc3949ba59abbe56e057f20f883e', '2014-11-10 18:02:58', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 'Active', b'0'),
	(10, '', '33', 'sunnydf', 'Dubey', 1, 0, '1', '', 'sheetesh1@inf.com', 'e10adc3949ba59abbe56e057f20f883e', '2014-11-10 18:09:21', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 'Delete', b'0'),
	(47, '', '33', 'Sheetesh', 'singhddd', 1, 1, 'MOHANA NAGAR*&DELHI', '', 'sheetesh@mindztechnology.com', '28adbd49651a3f28993e45084a812aa0', '2014-11-12 12:41:30', 1, '2014-11-14 14:45:18', 1, '0000-00-00 00:00:00', '', 'Active', b'0'),
	(48, '', '33', 'dklsfjasfq', 'singh', 1, 1, 'fds*&fdsfg', '', 'klsdgj@gmail.com', '3924d3f0bda58ec8a0073cf28836c962', '2014-11-14 13:09:06', 1, '2014-11-14 13:09:16', 1, '0000-00-00 00:00:00', '', 'Delete', b'0'),
	(49, '', '33', 'Ajay1Ajay', 'DwivediDwivedi', 1, 1, 'janak*&puri', '', 'dw@er.com', '5c1c91af634617c82077d1c93b3680cc', '2014-11-14 16:15:56', 1, '2014-11-18 12:03:05', 1, '0000-00-00 00:00:00', '', 'Active', b'0'),
	(50, '', '33', 'test ss amdin', 'admin', 1, 1, 'address1*&addres2', '', 'rahul2@mindztechnology.com', '96e79218965eb72c92a549dd5a330112', '2014-11-18 17:17:30', 2, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 'sheetesh', 'Delete', b'0'),
	(51, '', '33', 'Richa', 'Tiwari', 1, 5, 'Delhi*&Delhi', '', 'richa@mindztechnology.com', '96e79218965eb72c92a549dd5a330112', '2014-11-21 14:22:58', 1, '2014-11-21 15:57:29', 0, '2014-11-21 15:57:29', '', 'Active', b'0');
/*!40000 ALTER TABLE `tbl_systemlogin` ENABLE KEYS */;


-- Dumping structure for procedure trueexpence.test
DELIMITER //
CREATE  PROCEDURE `test`(IN `p_mode` varchar(20), IN `p_BusinessId` bigint, IN `p_Busineescode` varchar(80), IN `p_BussinessName` varchar(80), IN `p_Countryid` int, IN `p_StateId` int, IN `p_CityId` int, IN `p_Address` varchar(150), IN `p_Status` int , IN `p_Startdate` datetime, IN `p_EndDate` datetime, IN `p_UserCount` int , IN `p_CurrencyId` int, IN `p_ExpInOtrCurrency` bit, IN `p_Dateformat` varchar(50), IN `p_AdminId` int, IN `p_BillingType` int, IN `p_BillingName` varchar(100), IN `p_BillingAddr` varchar(150), IN `p_Package` int, IN `p_Distance` int, IN `p_Fname` varchar(80), IN `p_Lname` varchar(80), IN `p_ConidfAppInf` int, IN `p_StateIdfAppInf` int, IN `p_CityIdfAppInf` int, IN `p_AddrfAppInf` varchar(150) , IN `p_ContactfAppIn` varchar(20), IN `p_EmailfAppIn` varchar(30), IN `p_DobfAppIn` datetime, IN `p_PositionfAppIn` int, IN `p_AdminTypefAppIn` int , IN `p_CreatedOn` datetime, IN `p_CreatedBy` int , IN `p_Deleted` int)
BEGIN

declare a_BusinessId bigint;

     
if(p_mode='Insert')

then

insert into tblbusiness

(

t_BusinessCode,

t_BusinessName,

n_countryId,

n_StateId,

n_City,

t_Address,

n_Status,

d_StartDate,

d_EndDate,

n_UserCount,

n_CurrencyId,

b_ExpOtherCtry,

t_DateFormat,

n_AdminId,

n_BillingType,

t_Billingname,

t_BillingEmailAdd,

n_Package,

n_Distance,

d_CreatedOn,

n_CreatedBy,

b_Deleted

)

values

(

p_Busineescode ,

p_BussinessName ,

p_Countryid ,

p_StateId ,

p_CityId ,

p_Address ,

p_Status  ,

p_Startdate ,

p_EndDate ,

p_UserCount  ,

p_CurrencyId ,

p_ExpInOtrCurrency ,

p_Dateformat,

p_AdminId ,

p_BillingType ,

p_BillingName,

p_BillingAddr ,

p_Package ,

p_Distance ,

now(),

p_CreatedBy,

0);

select a_BusinessId;

SET a_BusinessId=LAST_INSERT_ID(); 

-- select a_BusinessId;

insert into tbl_businessadmin

(

t_AdminCode,

t_FirstName,

t_LastName,

n_CountyId,

n_CityId,

n_StateId,

t_Address,

t_Contact,

t_Email,

d_DOB,

n_Positon,

n_AdminType,

d_CreatedOn,

n_CreatedBy,

b_Deleted,

n_BusinessId

)

values

(

'test',

p_Fname ,

p_Lname ,

p_ConidfAppInf ,

p_StateIdfAppInf ,

p_CityIdfAppInf ,

p_AddrfAppInf  ,

p_ContactfAppIn ,

p_EmailfAppIn ,

p_DobfAppIn ,

p_PositionfAppIn ,

p_AdminTypefAppIn  ,

now(),

p_CreatedBy,

0 ,

a_BusinessId

);

end if;


END//
DELIMITER ;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
