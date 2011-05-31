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
    public function table() {
        return $this;
    }

    /**
     * Start table
     *
     * @author          Eddie Jaoude
     * @param           string $titles
     * @param           array $table
     * @return           void
     *
     */
    public function startTable($titles, $table=array()) {
        if (!is_array($titles)) {
            throw new Exception('Titles must be an array');
        }
        $table = '<table' . $this->attribute('id', !empty($table['id']) ? $table['id'] : null) . $this->attribute('class', !empty($table['class']) ? $table['class'] : null) . '>';
        $table .= '<thead><tr>';
        foreach ($titles as $k=>$v) {
            if (!is_array($v)) {
                throw new Exception('Each cell must be an array');
            }
            $table .= '<td' . $this->attribute('id', !empty($v['id']) ? $v['id'] : null) . $this->attribute('class', !empty($v['class']) ? $v['class'] : null) . '>' . $v['value'] . '</td>';
        }
        $table .= '</tr></thead>';
        $table .= '<body>';
        return $table;
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
            if (!is_string($title) || !is_string($value)) {
                throw new Exception('Attribute & value both must be a string');
            }
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
        if (!is_array($row)) {
            throw new Exception('Add row must be an array');
        }
        $rows = '';
        foreach ($row as $k=>$v) {
            $rows .= '<tr>';
            foreach ($v as $k=>$cell) {
                $rows .= '<td' . $this->attribute('id', $cell['id']) . $this->attribute('class', $cell['class']) . '>' . $cell['value'] . '</td>';
            }
            $rows .= '</tr>';
        }
        return $rows;
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
        $table = '</body>';
        $table .= '</table>';
        return $table;
    }

}