<?php
/**
 * Table helper
 *
 * @author          Eddie Jaoude
 * @package       Default Module
 *
 */
class Default_View_Helper_Table extends Zend_View_Helper_Abstract {

    /**
     * Table
     *
     * @author 	Eddie Jaoude
     * @param 	string $table
     *
     */
    protected $table = '';

    /**
     * Rows
     *
     * @author 	Eddie Jaoude
     * @param 	string $rows
     *
     */
    protected $rows = '';

    /**
     * default method
     *
     * @author          Eddie Jaoude
     * @param           string $titles
     * @param           array $table
     * @return           void
     *
     */
    public function table($titles, $table=array()) {
        $this->table = '';
        $this->table .= '<table' . $this->attribute('id', !empty($table['id']) ? $table['id'] : null) . $this->attribute('class', !empty($table['class']) ? $table['class'] : null) . '>';
        $this->table .= '<thead><tr>';
        foreach ($titles as $k=>$v) {
            $this->table .= '<td' . $this->attribute('id', !empty($v['id']) ? $v['id'] : null) . $this->attribute('class', !empty($v['class']) ? $v['class'] : null) . '>' . $v['value'] . '</td>';
        }
        $this->table .= '</tr></thead>';
        $this->table .= '<body>';
        return $this->table;
    }

    /**
     * attribute method
     *
     * @author          Eddie Jaoude
     * @param           string $title
     * @param           string $value
     * @return           string $result
     *
     */
    public function attribute($title, $value) {
        if (!empty($title) && !empty($value)) {
            $result = ' ' . $title . '="' . $value . '"';
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * Add row
     *
     * @author          Eddie Jaoude
     * @param           array $row
     * @return           void
     *
     */
    public function addRow($row) {
        foreach ($row as $k=>$v) {
            $this->rows .= '<tr>';
            $this->rows .= '<td' . $this->attribute('id', $v['id']) . $this->attribute('class', $v['class']) . '>' . $v['value'] . '</td>';
            $this->rows .= '</tr>';
        }
        return $this->rows;
    }

    /**
     * End table
     *
     * @author          Eddie Jaoude
     * @param           void
     * @return           string $this->table
     *
     */
    public function endTable() {
        $this->table .= '</body>';
        $this->table .= '</table>';
        return $this->table;
    }

}