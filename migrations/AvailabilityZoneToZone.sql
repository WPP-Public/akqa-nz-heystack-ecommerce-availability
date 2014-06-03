INSERT INTO `Heystack\DB\Zone` (ID, Created, LastEdited, Name)
  SELECT ID, Created, LastEdited, Name FROM AvailabilityZone;

INSERT INTO `Heystack\DB\Country` (`ID`, `Created`, `LastEdited`, `Name`, `CountryCode`, `IsDefault`, `ZoneID`)
  SELECT `ID`, `Created`, `LastEdited`, `Name`, `CountryCode`, `IsDefault`, `ZoneID` FROM AvailabilityCountry;
