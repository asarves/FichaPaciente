 -- Copyright (C) 2014      Ion Agorria          <cubexed@gmail.com>
 --
 -- This program is free software; you can redistribute it and/or modify
 -- it under the terms of the GNU General Public License as published by
 -- the Free Software Foundation; either version 3 of the License, or
 -- (at your option) any later version.
 --
 -- This program is distributed in the hope that it will be useful,
 -- but WITHOUT ANY WARRANTY; without even the implied warranty of
 -- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 -- GNU General Public License for more details.
 --
 -- You should have received a copy of the GNU General Public License
 -- along with this program. If not, see <http://www.gnu.org/licenses/>.

create table llx_fichapaciente
(
  rowid           	INTEGER AUTO_INCREMENT PRIMARY KEY,
  --header
  fk_patient    	  INTEGER	NOT NULL,
  optometrist   	  VARCHAR(100),
  test_date         DATE NOT NULL,
  --1 part
  anamnesis         VARCHAR(500),
  --2 part
  od_avsc           VARCHAR(20),
  od_avcc           VARCHAR(20),
  od_dnp            VARCHAR(20),
  od_kx             VARCHAR(20),
  oi_avsc           VARCHAR(20),
  oi_avcc           VARCHAR(20),
  oi_dnp            VARCHAR(20),
  oi_kx             VARCHAR(20),
  tests_2           VARCHAR(4),
  --3 part
  od_esf            VARCHAR(20),
  od_cil            VARCHAR(20),
  od_eje            VARCHAR(20),
  od_ad             VARCHAR(20),
  od_av             VARCHAR(20),
  oi_esf            VARCHAR(20),
  oi_cil            VARCHAR(20),
  oi_eje            VARCHAR(20),
  oi_ad             VARCHAR(20),
  oi_av             VARCHAR(20),
  --4 part
  tests_4           VARCHAR(7),
  note1_4           VARCHAR(80),
  note2_4           VARCHAR(80),
  note3_4           VARCHAR(80),
  note4_4           VARCHAR(80),
  note5_4           VARCHAR(80),
  note6_4           VARCHAR(80),
  note7_4           VARCHAR(80),
  --5 part
  note_5            VARCHAR(500)
) ENGINE=innodb;