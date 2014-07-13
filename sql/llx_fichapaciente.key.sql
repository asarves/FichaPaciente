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

ALTER TABLE llx_fichapaciente ADD INDEX idx_fk_patient (fk_patient);
ALTER TABLE `llx_fichapaciente` ADD FOREIGN KEY (`fk_patient`) REFERENCES `llx_societe` (`rowid`) ON DELETE CASCADE;
