//      Copyright (c) 2005, Regents of the University of California
//      All rights reserved.
//
//      Redistribution and use in source and binary forms, with or without
//      modification, are permitted provided that the following conditions are
//      met:
//
//        * Redistributions of source code must retain the above copyright notice,
//      this list of conditions and the following disclaimer.
//        * Redistributions in binary form must reproduce the above copyright
//      notice, this list of conditions and the following disclaimer in the
//      documentation and/or other materials provided with the distribution.
//        * Neither the name of the University of California, San Diego (UCSD) nor
//      the names of its contributors may be used to endorse or promote products
//      derived from this software without specific prior written permission.
//
//      THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS
//      IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
//      THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
//      PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
//      CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
//      EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
//      PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
//      PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
//      LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
//      NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
//      SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
//
//
//  FILE
//      PasswordMapper.java    -  edu.sdsc.grid.gui.applet.PasswordMapper
//
//  CLASS HIERARCHY
//      java.lang.Object
//          |
//          +-.PasswordMapper
//                   
//
//  PRINCIPAL AUTHOR
//      Alex Wu, SDSC/UCSD
//
//


package edu.sdsc.grid.gui.applet;

import java.util.Map;
import java.util.HashMap;

class PasswordMapper {
    private static Map map = new HashMap();
    
    public static void setPassword(String ruri, char[] password) {
        map.put(parseRuri(ruri), password);
    }
    
    public static char[] getPassword(String ruri) {
        return (char[]) map.get(parseRuri(ruri));
    }
    
    public static void removePassword(String ruri) {
        map.remove(ruri);
    }
    
    public static void clearMap() {
        map.clear();
    }
                        
    public static String parseRuri(String ruri) {
        // take out the destination and return the rest
        int i = ruri.indexOf("/", 8); // segment 'irods://' has eight characters
        return ruri.substring(0, i);
    }
    
}